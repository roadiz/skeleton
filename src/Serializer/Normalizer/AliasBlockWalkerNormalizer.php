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
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $normalized = $this->decorated->normalize($data, $format, $context);

        if (!is_array($normalized)) {
            return $normalized;
        }
        if (!$data instanceof AutoChildrenNodeSourceWalker) {
            return $normalized;
        }

        $block = $data->getItem();
        if (!$block instanceof NSAliasBlock || 0 === count($block->getBlockSources())) {
            return $normalized;
        }
        $aliasedBlock = $block->getBlockSources()[0];
        if (!$aliasedBlock->getNode()->isPublished() && !$this->previewResolver->isPreview()) {
            return $normalized;
        }

        $normalized['item'] = $this->itemNormalizer->normalize($aliasedBlock, $format, $context);

        return $normalized;
    }

    #[\Override]
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $this->decorated->supportsNormalization($data, $format/* , $context */);
    }

    #[\Override]
    public function getSupportedTypes(?string $format): array
    {
        return $this->decorated->getSupportedTypes($format);
    }
}
