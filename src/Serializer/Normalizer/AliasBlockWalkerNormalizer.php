<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use App\GeneratedEntity\NSAliasBlock;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\AutoChildrenNodeSourceWalker;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class AliasBlockWalkerNormalizer implements NormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.jsonld.normalizer.object')]
        private NormalizerInterface $normalizer,
    ) {
    }

    #[\Override]
    public function normalize($object, ?string $format = null, array $context = []): mixed
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        if (!is_array($data)) {
            return $data;
        }
        if (!$object instanceof AutoChildrenNodeSourceWalker) {
            return $data;
        }
        $block = $object->getItem();
        if (!$block instanceof NSAliasBlock || 0 === count($block->getBlockSources())) {
            return $data;
        }

        // Magic happens here, we replace TreeWalker item (Alias) with its referenced block
        // We need to use `api_platform.jsonld.normalizer.object` normalizer to get LD-JSON formatting
        $data['item'] = $this->normalizer->normalize($block->getBlockSources()[0], $format, $context);

        return $data;
    }

    #[\Override]
    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof AutoChildrenNodeSourceWalker;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            // Do not cache this normalizer as it is used for dynamic content
            AutoChildrenNodeSourceWalker::class => false,
        ];
    }
}
