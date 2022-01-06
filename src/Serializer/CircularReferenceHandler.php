<?php

declare(strict_types=1);

namespace App\Serializer;

use ApiPlatform\Core\Api\IriConverterInterface;

final class CircularReferenceHandler
{
    private IriConverterInterface $iriConverter;

    /**
     * @param IriConverterInterface $iriConverter
     */
    public function __construct(IriConverterInterface $iriConverter)
    {
        $this->iriConverter = $iriConverter;
    }

    /**
     * @param mixed $object
     * @return string
     */
    public function __invoke($object, string $format = null, array $context = [])
    {
        try {
            return $this->iriConverter->getIriFromItem($object);
        } catch (\InvalidArgumentException $exception) {
            if (is_object($object) && method_exists($object, 'getId')) {
                return (string) $object->getId();
            }
            return '';
        }
    }
}
