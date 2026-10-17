<?php

declare(strict_types=1);

namespace App\Serializer\Enricher;

use App\GeneratedEntity\NSMenuLink;
use RZ\Roadiz\CoreBundle\Serializer\Enricher\NormalizationEnricherInterface;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final readonly class MenuLinkPathEnricher implements NormalizationEnricherInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    #[\Override]
    public function supports(object $data, ?string $format, array $context): bool
    {
        return $data instanceof NSMenuLink;
    }

    /**
     * @param NSMenuLink $data
     */
    #[\Override]
    public function enrich(array $normalized, object $data, ?string $format, array $context): array
    {
        $actualUrl = $data->getLinkExternalUrl() ?? null;
        if (isset($data->getLinkInternalReferenceSources()[0])) {
            $actualUrl = $this->urlGenerator->generate(
                RouteObjectInterface::OBJECT_BASED_ROUTE_NAME,
                [
                    RouteObjectInterface::ROUTE_OBJECT => $data->getLinkInternalReferenceSources()[0],
                ]
            );
        }
        $normalized['url'] = $actualUrl;

        return $normalized;
    }
}
