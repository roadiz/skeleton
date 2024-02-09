<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\Model\CommonContent;
use App\TreeWalker\MenuNodeSourceWalker;
use Doctrine\Persistence\ManagerRegistry;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Api\Model\NodesSourcesHeadFactoryInterface;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\AutoChildrenNodeSourceWalker;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\TreeWalkerGenerator;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\Roadiz\CoreBundle\Repository\TranslationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

final class GetCommonContentController extends AbstractController
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly NodesSourcesHeadFactoryInterface $nodesSourcesHeadFactory,
        private readonly PreviewResolverInterface $previewResolver,
        private readonly TreeWalkerGenerator $treeWalkerGenerator
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
            return $resource;
        } catch (ResourceNotFoundException $exception) {
            throw $this->createNotFoundException($exception->getMessage(), $exception);
        }
    }

    private function getErrorPage(TranslationInterface $translation): ?NodesSources
    {
        if (!class_exists('\App\GeneratedEntity\NSErrorPage')) {
            return null;
        }
        // @phpstan-ignore-next-line
        return $this->managerRegistry->getRepository('\App\GeneratedEntity\NSErrorPage')
            ->findOneBy([
                'translation' => $translation,
                'node.nodeName' => 'error-page'
            ]);
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
            throw new NotFoundHttpException('No translation for locale ' . $locale);
        }
        return $translation;
    }

    private function getTranslationRepository(): TranslationRepository
    {
        $repository = $this->managerRegistry->getRepository(TranslationInterface::class);
        if (!$repository instanceof TranslationRepository) {
            throw new \RuntimeException(
                'Translation repository must be instance of ' .
                TranslationRepository::class
            );
        }
        return $repository;
    }
}
