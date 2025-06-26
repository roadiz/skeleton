<?php

declare(strict_types=1);

namespace App\TreeWalker\Definition;

use App\GeneratedEntity\NSAliasBlock;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\NodeSourceWalkerContext;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\TreeWalker\AbstractWalker;
use RZ\TreeWalker\Definition\ContextualDefinitionTrait;

final class AliasBlockDefinition
{
    use ContextualDefinitionTrait;

    /**
     * Get real block children.
     */
    public function __invoke(NodesSources $source, AbstractWalker $walker): array
    {
        if (!$this->context instanceof NodeSourceWalkerContext || !$source instanceof NSAliasBlock) {
            throw new \InvalidArgumentException('Context should be instance of '.NodeSourceWalkerContext::class);
        }
        $walker->addMetadata('realType', $source->getNodeTypeName());
        $walker->addMetadata('realSlug', $source->getIdentifier());
        $walker->addMetadata('realItem', $source);
        if (!isset($source->getBlockSources()[0])) {
            return [];
        }
        $realBlock = $source->getBlockSources()[0];
        /*
         * Use Alias title OR referenced slide title
         */
        $walker->addMetadata(
            'realTitle',
            $source->getTitle()
        );
        $callable = $walker->getDefinitionForItem($realBlock);

        return $callable($realBlock, $walker);
    }
}
