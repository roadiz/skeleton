<?php

declare(strict_types=1);

namespace App\TreeWalker;

use RZ\Roadiz\Contracts\NodeType\NodeTypeInterface;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\Definition\MultiTypeChildrenDefinition;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\NodeSourceWalkerContext;
use RZ\TreeWalker\AbstractCycleAwareWalker;
use RZ\TreeWalker\Definition\ZeroChildrenDefinition;

/**
 * @package App\TreeWalker
 */
final class MenuNodeSourceWalker extends AbstractCycleAwareWalker
{
    protected function initializeDefinitions(): void
    {
        if ($this->isRoot()) {
            $context = $this->getContext();
            if ($context instanceof NodeSourceWalkerContext) {
                $nodeType = $context->getNodeTypesBag()->get('Menu');
                if ($nodeType instanceof NodeTypeInterface) {
                    $this->addDefinition(
                        $nodeType->getSourceEntityFullQualifiedClassName(),
                        $this->createDefinitionForNodeType($nodeType)
                    );
                }
            }
        }
    }

    protected function createDefinitionForNodeType(NodeTypeInterface $nodeType): callable
    {
        $context = $this->getContext();
        if (!$context instanceof NodeSourceWalkerContext) {
            throw new \InvalidArgumentException(
                'TreeWalker context must be instance of ' .
                NodeSourceWalkerContext::class
            );
        }
        $childrenNodeTypes = $context->getNodeTypeResolver()->getChildrenNodeTypeList($nodeType);
        if (count($childrenNodeTypes) > 0) {
            return new MultiTypeChildrenDefinition($this->getContext(), $childrenNodeTypes, false);
        }

        return new ZeroChildrenDefinition($this->getContext());
    }
}
