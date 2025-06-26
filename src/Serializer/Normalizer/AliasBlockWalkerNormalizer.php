<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use App\GeneratedEntity\NSAliasBlock;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\AutoChildrenNodeSourceWalker;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class AliasBlockWalkerNormalizer implements NormalizerInterface
{
    public function __construct(
        private NormalizerInterface $decorated,
        private NormalizerInterface $itemNormalizer,
        private PreviewResolverInterface $previewResolver,
    ) {
    }

    #[\Override]
    public function normalize($object, ?string $format = null, array $context = []): mixed
    {
        $data = $this->decorated->normalize($object, $format, $context);

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
        $aliasedBlock = $block->getBlockSources()[0];
        if (!$aliasedBlock->getNode()->isPublished() && !$this->previewResolver->isPreview()) {
            return $data;
        }

        $data['item'] = $this->itemNormalizer->normalize($aliasedBlock, $format, $context);

        return $data;
    }

    #[\Override]
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $this->decorated->supportsNormalization($data, $format/* , $context */);
    }

    public function getSupportedTypes(?string $format): array
    {
        return $this->decorated->getSupportedTypes($format);
    }
}
