<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use App\GeneratedEntity\NSMenuLink;
use RZ\Roadiz\CoreBundle\Serializer\Normalizer\AbstractPathNormalizer;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

final class MenuLinkPathNormalizer extends AbstractPathNormalizer
{
    #[\Override]
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $normalized = $this->decorated->normalize($data, $format, $context);
        if (($data instanceof NSMenuLink) && is_array($normalized)) {
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
        }

        return $normalized;
    }
}
