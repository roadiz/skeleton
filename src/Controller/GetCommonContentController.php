<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\Model\CommonContent;
use App\TreeWalker\MenuNodeSourceWalker;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Cache\CacheItemPoolInterface;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Api\Model\NodesSourcesHeadFactoryInterface;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\AutoChildrenNodeSourceWalker;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\TreeWalkerGenerator;
use RZ\Roadiz\CoreBundle\Bag\Settings;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\Roadiz\CoreBundle\Repository\TranslationRepository;
use RZ\TreeWalker\WalkerContextInterface;
use RZ\TreeWalker\WalkerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use function Symfony\Component\String\u;

final class GetCommonContentController extends AbstractController
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly NodesSourcesHeadFactoryInterface $nodesSourcesHeadFactory,
        private readonly PreviewResolverInterface $previewResolver,
        private readonly TreeWalkerGenerator $treeWalkerGenerator,
        private readonly WalkerContextInterface $walkerContext,
        private readonly CacheItemPoolInterface $cacheItemPool,
        private readonly Settings $settingsBag,
    ) {
    }

    public function __invoke(Request $request): ?CommonContent
    {
        try {
            $translation = $this->getTranslationFromRequest($request);

            $resource = new CommonContent();

            $request->attributes->set('data', $resource);
            $resource->head = $this->nodesSourcesHeadFactory->createForTranslation($translation);
            $resource->home = $resource->head->getHomePage();
            $resource->errorPage = $this->getErrorPage($translation);
            $resource->menus = $this->treeWalkerGenerator->getTreeWalkersForTypeAtRoot(
                'Menu',
                MenuNodeSourceWalker::class,
                $translation,
                3
            );
            $resource->footers = $this->treeWalkerGenerator->getTreeWalkersForTypeAtRoot(
                'Footer',
                AutoChildrenNodeSourceWalker::class,
                $translation,
                4
            );

            /*
             * Provide all *_url and *_color settings. Make sure to not create private settings using these keys.
             */
            $urlKeys = array_filter(
                $this->settingsBag->keys(),
                fn (string $key) => str_ends_with($key, '_url') && !empty($this->settingsBag->get($key)),
            );
            $resource->urls = [];
            foreach ($urlKeys as $urlKey) {
                $resource->urls[u($urlKey)->camel()->toString()] = $this->settingsBag->get($urlKey);
            }

            $colorKeys = array_filter(
                $this->settingsBag->keys(),
                fn (string $key) => str_ends_with($key, '_color') && !empty($this->settingsBag->get($key)),
            );
            $resource->colors = [];
            foreach ($colorKeys as $colorKey) {
                $resource->colors[$colorKey] = $this->settingsBag->get($colorKey);
            }

            return $resource;
        } catch (ResourceNotFoundException $exception) {
            throw $this->createNotFoundException($exception->getMessage(), $exception);
        }
    }

    private function getErrorPage(TranslationInterface $translation): ?WalkerInterface
    {
        if (!class_exists('\App\GeneratedEntity\NSErrorPage')) {
            return null;
        }

        $errorPage = $this->managerRegistry->getRepository('\App\GeneratedEntity\NSErrorPage')->findOneBy([
            'translation' => $translation,
        ]);

        if (null === $errorPage) {
            return null;
        }

        return $this->treeWalkerGenerator->buildForRoot(
            $errorPage,
            AutoChildrenNodeSourceWalker::class,
            $this->walkerContext,
            3,
            $this->cacheItemPool
        );
    }

    private function getTranslationFromRequest(?Request $request): TranslationInterface
    {
        $locale = null;

        if (null !== $request) {
            $locale = $request->query->get('_locale');

            /*
             * If no _locale query param is defined check Accept-Language header
             */
            if (null === $locale) {
                $locale = $request->getPreferredLanguage($this->getTranslationRepository()->getAllLocales());
            }
        }
        /*
         * Then fallback to default CMS locale
         */
        if (null === $locale) {
            $translation = $this->getTranslationRepository()->findDefault();
        } elseif ($this->previewResolver->isPreview()) {
            $translation = $this->getTranslationRepository()
                ->findOneByLocaleOrOverrideLocale((string) $locale);
        } else {
            $translation = $this->getTranslationRepository()
                ->findOneAvailableByLocaleOrOverrideLocale((string) $locale);
        }
        if (null === $translation) {
            throw new NotFoundHttpException('No translation for locale '.$locale);
        }

        return $translation;
    }

    private function getTranslationRepository(): TranslationRepository
    {
        $repository = $this->managerRegistry->getRepository(TranslationInterface::class);
        if (!$repository instanceof TranslationRepository) {
            throw new \RuntimeException('Translation repository must be instance of '.TranslationRepository::class);
        }

        return $repository;
    }
}
