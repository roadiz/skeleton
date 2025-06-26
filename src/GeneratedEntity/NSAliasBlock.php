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
use JMS\Serializer\Annotation as JMS;
use RZ\Roadiz\CoreBundle\Entity\Node;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Entity\Translation;
use RZ\Roadiz\CoreBundle\Entity\UserLogEntry;
use Symfony\Component\Serializer\Attribute as Serializer;

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
    #[JMS\Exclude]
    private ?array $blockSources = null;

    /**
     * @return \RZ\Roadiz\CoreBundle\Entity\NodesSources[]
     */
    #[JMS\Exclude]
    #[Serializer\Ignore]
    #[JMS\VirtualProperty]
    #[JMS\SerializedName('block')]
    #[JMS\Type('array<RZ\Roadiz\CoreBundle\Entity\NodesSources>')]
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

    #[JMS\VirtualProperty]
    #[JMS\Groups(['nodes_sources', 'nodes_sources_default'])]
    #[JMS\SerializedName('@type')]
    #[Serializer\Groups(['nodes_sources', 'nodes_sources_default'])]
    #[Serializer\SerializedName(serializedName: '@type')]
    #[\Override]
    public function getNodeTypeName(): string
    {
        return 'AliasBlock';
    }

    #[JMS\VirtualProperty]
    #[JMS\Groups(['node_type'])]
    #[JMS\SerializedName('nodeTypeColor')]
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
    #[JMS\VirtualProperty]
    #[\Override]
    public function isReachable(): bool
    {
        return false;
    }

    /**
     * $this->nodeType->isPublishable() proxy.
     * @return bool Does this nodeSource is publishable with date and time?
     */
    #[JMS\VirtualProperty]
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
