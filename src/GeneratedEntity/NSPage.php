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
 * Page node-source entity.
 */
#[Gedmo\Loggable(logEntryClass: UserLogEntry::class)]
#[ORM\Entity(repositoryClass: Repository\NSPageRepository::class)]
#[ORM\Table(name: 'ns_page')]
#[ApiFilter(PropertyFilter::class)]
class NSPage extends NodesSources
{
    #[Serializer\Groups(['nodes_sources', 'nodes_sources_default'])]
    #[Serializer\SerializedName(serializedName: '@type')]
    #[\Override]
    public function getNodeTypeName(): string
    {
        return 'Page';
    }

    #[Serializer\Groups(['node_type'])]
    #[Serializer\SerializedName(serializedName: 'nodeTypeColor')]
    #[\Override]
    public function getNodeTypeColor(): string
    {
        return '#000000';
    }

    /**
     * $this->nodeType->isReachable() proxy.
     * @return bool Does this nodeSource is reachable over network?
     */
    #[\Override]
    public function isReachable(): bool
    {
        return true;
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
        return '[NSPage] ' . parent::__toString();
    }
}
