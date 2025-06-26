<?php

declare(strict_types=1);

namespace App\TreeWalker\Definition;

use App\GeneratedEntity\NSAliasBlock;
use RZ\Roadiz\CoreBundle\Api\TreeWalker\Definition\DefinitionFactoryInterface;
use RZ\TreeWalker\WalkerContextInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(
    name: 'roadiz_core.tree_walker_definition_factory',
    attributes: ['classname' => NSAliasBlock::class]
)]
final readonly class AliasBlockDefinitionFactory implements DefinitionFactoryInterface
{
    #[\Override]
    public function create(WalkerContextInterface $context, bool $onlyVisible = true): callable
    {
        return new AliasBlockDefinition($context);
    }
}
