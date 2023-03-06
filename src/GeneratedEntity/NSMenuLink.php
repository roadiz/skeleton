<?php

declare(strict_types=1);

/*
 * THIS IS A GENERATED FILE, DO NOT EDIT IT
 * IT WILL BE RECREATED AT EACH NODE-TYPE UPDATE
 */
namespace App\GeneratedEntity;

use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation as SymfonySerializer;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter as OrmFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;

/**
 * DO NOT EDIT
 * Generated custom node-source type by Roadiz.
 */
#[
    Gedmo\Loggable(logEntryClass: \RZ\Roadiz\CoreBundle\Entity\UserLogEntry::class),
    ORM\Entity(repositoryClass: \App\GeneratedEntity\Repository\NSMenuLinkRepository::class),
    ORM\Table(name: "ns_menulink"),
    ApiFilter(PropertyFilter::class)
]
class NSMenuLink extends \RZ\Roadiz\CoreBundle\Entity\NodesSources
{
    /**
     * URL externe.
     */
    #[
        SymfonySerializer\SerializedName(serializedName: "linkExternalUrl"),
        SymfonySerializer\Groups(["nodes_sources", "nodes_sources_default"]),
        SymfonySerializer\MaxDepth(2),
        Gedmo\Versioned,
        ORM\Column(
            name: "link_external_url",
            type: "string",
            nullable: true,
            length: 250
        ),
        Serializer\Groups(["nodes_sources", "nodes_sources_default"]),
        Serializer\MaxDepth(2),
        Serializer\Type("string")
    ]
    private ?string $linkExternalUrl = null;

    /**
     * @return string|null
     */
    public function getLinkExternalUrl(): ?string
    {
        return $this->linkExternalUrl;
    }

    /**
     * @param string|null $linkExternalUrl
     *
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
     * linkInternalReferenceSources NodesSources direct field buffer.
     * (Virtual field, this var is a buffer)
     *
     * Default values: Page
     * @var \RZ\Roadiz\CoreBundle\Entity\NodesSources[]|null
     */
    #[
        Serializer\Exclude,
        SymfonySerializer\SerializedName(serializedName: "linkInternalReference"),
        SymfonySerializer\Groups(["nodes_sources", "nodes_sources_default", "nodes_sources_nodes"]),
        SymfonySerializer\MaxDepth(2)
    ]
    private ?array $linkInternalReferenceSources = null;

    /**
     * @return \RZ\Roadiz\CoreBundle\Entity\NodesSources[] linkInternalReference nodes-sources array
     */
    #[
        Serializer\Groups(["nodes_sources", "nodes_sources_default", "nodes_sources_nodes"]),
        Serializer\MaxDepth(2),
        Serializer\VirtualProperty,
        Serializer\SerializedName("linkInternalReference"),
        Serializer\Type("array<RZ\Roadiz\CoreBundle\Entity\NodesSources>")
    ]
    public function getLinkInternalReferenceSources(): array
    {
        if (null === $this->linkInternalReferenceSources) {
            if (
                null !== $this->objectManager &&
                null !== $this->getNode() &&
                null !== $this->getNode()->getNodeType()
            ) {
                $this->linkInternalReferenceSources = $this->objectManager
                    ->getRepository(\RZ\Roadiz\CoreBundle\Entity\NodesSources::class)
                    ->findByNodesSourcesAndFieldAndTranslation(
                        $this,
                        $this->getNode()->getNodeType()->getFieldByName("link_internal_reference")
                    );
            } else {
                $this->linkInternalReferenceSources = [];
            }
        }
        return $this->linkInternalReferenceSources;
    }

    /**
     * @param \RZ\Roadiz\CoreBundle\Entity\NodesSources[]|null $linkInternalReferenceSources
     *
     * @return $this
     */
    public function setLinkInternalReferenceSources(?array $linkInternalReferenceSources): static
    {
        $this->linkInternalReferenceSources = $linkInternalReferenceSources;

        return $this;
    }


    #[
        Serializer\VirtualProperty,
        Serializer\Groups(["nodes_sources", "nodes_sources_default"]),
        Serializer\SerializedName("@type"),
        SymfonySerializer\Groups(["nodes_sources", "nodes_sources_default"]),
        SymfonySerializer\SerializedName(serializedName: "@type")
    ]
    public function getNodeTypeName(): string
    {
        return 'MenuLink';
    }

    /**
     * $this->nodeType->isReachable() proxy.
     *
     * @return bool Does this nodeSource is reachable over network?
     */
    public function isReachable(): bool
    {
        return false;
    }

    /**
     * $this->nodeType->isPublishable() proxy.
     *
     * @return bool Does this nodeSource is publishable with date and time?
     */
    public function isPublishable(): bool
    {
        return false;
    }

    public function __toString()
    {
        return '[NSMenuLink] ' . parent::__toString();
    }
}
