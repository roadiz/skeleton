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
 * MenuLink node-source entity.
 */
#[Gedmo\Loggable(logEntryClass: UserLogEntry::class)]
#[ORM\Entity(repositoryClass: Repository\NSMenuLinkRepository::class)]
#[ORM\Table(name: 'ns_menulink')]
#[ApiFilter(PropertyFilter::class)]
class NSMenuLink extends NodesSources
{
    /** External URL. */
    #[Serializer\SerializedName(serializedName: 'linkExternalUrl')]
    #[Serializer\Groups(['nodes_sources', 'nodes_sources_default'])]
    #[ApiProperty(description: 'External URL')]
    #[Serializer\MaxDepth(2)]
    #[Gedmo\Versioned]
    #[ORM\Column(name: 'link_external_url', type: 'string', nullable: true, length: 250)]
    private ?string $linkExternalUrl = null;

    /**
     * linkInternalReferenceSources NodesSources direct field buffer.
     * @var \App\GeneratedEntity\NSPage[]|null
     * Node reference (internal link).
     * Default values:
     * - Page
     */
    #[Serializer\SerializedName(serializedName: 'linkInternalReference')]
    #[Serializer\Groups(['nodes_sources', 'nodes_sources_default', 'nodes_sources_nodes'])]
    #[ApiProperty(description: 'Node reference (internal link)')]
    #[Serializer\MaxDepth(2)]
    #[Serializer\Context(
        normalizationContext: [
        'groups' => ['urls', 'get', 'nodes_sources_base', 'nodes_sources_default', 'tag_base', 'document_display'],
        'skip_null_value' => true,
        'jsonld_embed_context' => false,
        'enable_max_depth' => true,
    ],
        groups: ['nodes_sources', 'nodes_sources_default', 'nodes_sources_nodes'],
    )]
    private ?array $linkInternalReferenceSources = null;

    /**
     * @return string|null
     */
    public function getLinkExternalUrl(): ?string
    {
        return $this->linkExternalUrl;
    }

    /**
     * @return $this
     */
    public function setLinkExternalUrl(?string $linkExternalUrl): static
    {
        $this->linkExternalUrl = null !== $linkExternalUrl ?
                    (string) $linkExternalUrl :
                    null;
        return $this;
    }

    /**
     * @return \App\GeneratedEntity\NSPage[]
     */
    public function getLinkInternalReferenceSources(): array
    {
        if (null === $this->linkInternalReferenceSources) {
            if (null !== $this->objectManager) {
                $this->linkInternalReferenceSources = $this->objectManager
                    ->getRepository(\App\GeneratedEntity\NSPage::class)
                    ->findByNodesSourcesAndFieldNameAndTranslation(
                        $this,
                        'link_internal_reference',
                        []
                    );
            } else {
                $this->linkInternalReferenceSources = [];
            }
        }
        return $this->linkInternalReferenceSources;
    }

    /**
     * @param \App\GeneratedEntity\NSPage[]|null $linkInternalReferenceSources
     * @return $this
     */
    public function setLinkInternalReferenceSources(?array $linkInternalReferenceSources): static
    {
        $this->linkInternalReferenceSources = $linkInternalReferenceSources;
        return $this;
    }

    #[Serializer\Groups(['nodes_sources', 'nodes_sources_default'])]
    #[Serializer\SerializedName(serializedName: '@type')]
    #[\Override]
    public function getNodeTypeName(): string
    {
        return 'MenuLink';
    }

    #[Serializer\Groups(['node_type'])]
    #[Serializer\SerializedName(serializedName: 'nodeTypeColor')]
    #[\Override]
    public function getNodeTypeColor(): string
    {
        return '#6369c2';
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
        return '[NSMenuLink] ' . parent::__toString();
    }
}
