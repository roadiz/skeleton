<?php

/**
 * THIS IS A GENERATED FILE, DO NOT EDIT IT.
 * IT WILL BE RECREATED AT EACH NODE-TYPE UPDATE.
 */

declare(strict_types=1);

namespace App\GeneratedEntity;

use ApiPlatform\Doctrine\Orm\Filter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Serializer\Filter\PropertyFilter;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use RZ\Roadiz\CoreBundle\Entity\Node;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Entity\Translation;
use RZ\Roadiz\CoreBundle\Entity\UserLogEntry;
use Symfony\Component\Serializer\Attribute as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AliasBlock node-source entity.
 */
#[Gedmo\Loggable(logEntryClass: UserLogEntry::class)]
#[ORM\Entity(repositoryClass: Repository\NSAliasBlockRepository::class)]
#[ORM\Table(name: 'ns_aliasblock')]
#[ApiFilter(PropertyFilter::class)]
class NSAliasBlock extends NodesSources
{
    /**
     * blockSources NodesSources direct field buffer.
     * @var \RZ\Roadiz\CoreBundle\Entity\NodesSources[]|null
     * Reference to a block.
     */
    private ?array $blockSources = null;

    /**
     * @return \RZ\Roadiz\CoreBundle\Entity\NodesSources[]
     */
    #[Serializer\Ignore]
    public function getBlockSources(): array
    {
        if (null === $this->blockSources) {
            if (null !== $this->objectManager) {
                $this->blockSources = $this->objectManager
                    ->getRepository(\RZ\Roadiz\CoreBundle\Entity\NodesSources::class)
                    ->findByNodesSourcesAndFieldNameAndTranslation(
                        $this,
                        'block',
                        []
                    );
            } else {
                $this->blockSources = [];
            }
        }
        return $this->blockSources;
    }

    /**
     * @param \RZ\Roadiz\CoreBundle\Entity\NodesSources[]|null $blockSources
     * @return $this
     */
    public function setBlockSources(?array $blockSources): static
    {
        $this->blockSources = $blockSources;
        return $this;
    }

    #[Serializer\Groups(['nodes_sources', 'nodes_sources_default'])]
    #[Serializer\SerializedName(serializedName: '@type')]
    #[\Override]
    public function getNodeTypeName(): string
    {
        return 'AliasBlock';
    }

    #[Serializer\Groups(['node_type'])]
    #[Serializer\SerializedName(serializedName: 'nodeTypeColor')]
    #[\Override]
    public function getNodeTypeColor(): string
    {
        return '#a66503';
    }

    /**
     * $this->nodeType->isReachable() proxy.
     * @return bool Does this nodeSource is reachable over network?
     */
    #[\Override]
    public function isReachable(): bool
    {
        return false;
    }

    /**
     * $this->nodeType->isPublishable() proxy.
     * @return bool Does this nodeSource is publishable with date and time?
     */
    #[\Override]
    public function isPublishable(): bool
    {
        return false;
    }

    #[\Override]
    public function __toString(): string
    {
        return '[NSAliasBlock] ' . parent::__toString();
    }
}
