<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\Model\CommonContent;
use App\TreeWalker\MenuNodeSourceWalker;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Cache\CacheItemPoolInterface;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Api\Controller\TranslationAwareControllerTrait;
use RZ\Roadiz\CoreBundle\Api\Model\NodesSourcesHeadFactoryInterface;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\AutoChildrenNodeSourceWalker;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\TreeWalkerGenerator;
use RZ\Roadiz\CoreBundle\Bag\Settings;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\TreeWalker\WalkerContextInterface;
use RZ\TreeWalker\WalkerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

use function Symfony\Component\String\u;

final class GetCommonContentController extends AbstractController
{
    use TranslationAwareControllerTrait;

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

    #[\Override]
    protected function getManagerRegistry(): ManagerRegistry
    {
        return $this->managerRegistry;
    }

    #[\Override]
    protected function getPreviewResolver(): PreviewResolverInterface
    {
        return $this->previewResolver;
    }

    public function __invoke(Request $request): CommonContent
    {
        try {
            $translation = $this->getTranslation($request);

            $resource = new CommonContent();

            $request->attributes->set('data', $resource);
            $resource->head = $this->nodesSourcesHeadFactory->createForTranslation($translation);
            $resource->home = $this->getHomePage($translation);
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

            /**
             * @var string[] $keys
             */
            $keys = $this->settingsBag->keys();
            /**
             * Provide all *_url and *_color settings. Make sure to not create private settings using these keys.
             */
            $urlKeys = array_filter(
                $keys,
                fn (string $key) => str_ends_with($key, '_url') && !empty($this->settingsBag->get($key)),
            );
            $resource->urls = [];
            foreach ($urlKeys as $urlKey) {
                $resource->urls[u($urlKey)->camel()->toString()] = $this->settingsBag->get($urlKey);
            }

            $colorKeys = array_filter(
                $keys,
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

    private function getHomePage(TranslationInterface $translation): ?NodesSources
    {
        return $this->managerRegistry->getRepository(NodesSources::class)->findOneBy([
            'node.home' => true,
            'translation' => $translation,
        ]);
    }

    private function getErrorPage(TranslationInterface $translation): ?WalkerInterface
    {
        if (!class_exists('\App\GeneratedEntity\NSErrorPage')) {
            return null;
        }

        /* @phpstan-ignore-next-line */
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
}
