<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use App\GeneratedEntity\NSMenuLink;
use RZ\Roadiz\CoreBundle\Serializer\Normalizer\AbstractPathNormalizer;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

final class MenuLinkPathNormalizer extends AbstractPathNormalizer
{
    /**
     * @param mixed $object
     * @param string|null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|mixed|string|null
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->decorated->normalize($object, $format, $context);
        if (($object instanceof NSMenuLink) && is_array($data)) {
            $actualUrl = $object->getLinkExternalUrl() ?? null;
            if (isset($object->getLinkInternalReferenceSources()[0])) {
                $actualUrl = $this->urlGenerator->generate(
                    RouteObjectInterface::OBJECT_BASED_ROUTE_NAME,
                    [
                        RouteObjectInterface::ROUTE_OBJECT => $object->getLinkInternalReferenceSources()[0]
                    ]
                );
            }
            $data['url'] = $actualUrl;
        }
        return $data;
    }
}
