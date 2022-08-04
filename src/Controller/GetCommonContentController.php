<?php

declare(strict_types=1);

namespace App\Controller;

use App\Api\Model\CommonContent;
use Doctrine\Persistence\ManagerRegistry;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Api\Model\NodesSourcesHeadFactory;
use RZ\Roadiz\CoreBundle\EntityApi\NodeSourceApi;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\Roadiz\CoreBundle\Repository\TranslationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

final class GetCommonContentController extends AbstractController
{
    private RequestStack $requestStack;
    private ManagerRegistry $managerRegistry;
    private NodeSourceApi $nodeSourceApi;
    private NodesSourcesHeadFactory $nodesSourcesHeadFactory;
    private PreviewResolverInterface $previewResolver;

    public function __construct(
        RequestStack $requestStack,
        ManagerRegistry $managerRegistry,
        NodeSourceApi $nodeSourceApi,
        NodesSourcesHeadFactory $nodesSourcesHeadFactory,
        PreviewResolverInterface $previewResolver
    ) {
        $this->requestStack = $requestStack;
        $this->nodeSourceApi = $nodeSourceApi;
        $this->managerRegistry = $managerRegistry;
        $this->nodesSourcesHeadFactory = $nodesSourcesHeadFactory;
        $this->previewResolver = $previewResolver;
    }

    public function __invoke(): ?CommonContent
    {
        try {
            $request = $this->requestStack->getMainRequest();
            $translation = $this->getTranslationFromRequest($request);
            $home = $this->nodeSourceApi->getOneBy([
                'node.home' => true,
                'translation' => $translation
            ]);

            $resource = new CommonContent();
            if (null !== $home) {
                $resource->home = $home;
            }

            if (null !== $request) {
                $request->attributes->set('data', $resource);
            }
            $resource->head = $this->nodesSourcesHeadFactory->createForTranslation($translation);
            return $resource;
        } catch (ResourceNotFoundException $exception) {
            throw new NotFoundHttpException($exception->getMessage(), $exception);
        }
    }

    protected function getTranslationFromRequest(?Request $request): TranslationInterface
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

    protected function getTranslationRepository(): TranslationRepository
    {
        return $this->managerRegistry->getRepository(TranslationInterface::class);
    }
}
