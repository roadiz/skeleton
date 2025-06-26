<?php

/**
 * THIS IS A GENERATED FILE, DO NOT EDIT IT.
 * IT WILL BE RECREATED AT EACH NODE-TYPE UPDATE.
 */

declare(strict_types=1);

namespace App\GeneratedEntity\Repository;

use App\GeneratedEntity\NSMenuLink;
use Doctrine\Persistence\ManagerRegistry;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Entity\Node;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\Roadiz\CoreBundle\Repository\NodesSourcesRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @extends NodesSourcesRepository<NSMenuLink>
 * @method NSMenuLink|null   find($id, $lockMode = null, $lockVersion = null)
 * @method NSMenuLink|null   findOneBy(array $criteria, array $orderBy = null)
 * @method NSMenuLink[]      findAll()
 * @method NSMenuLink[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method NSMenuLink|null   findOneByIdentifierAndTranslation(string $identifier, ?TranslationInterface $translation, bool $availableTranslation = false)
 * @method NSMenuLink|null   findOneByNodeAndTranslation(Node $node, ?TranslationInterface $translation)
 * @method NSMenuLink[]|null findByNodesSourcesAndFieldNameAndTranslation(NodesSources $nodesSources, string $fieldName, array $nodeSourceClasses = [])
 * @method int countBy(mixed $criteria)
 */
final class NSMenuLinkRepository extends NodesSourcesRepository
{
    public function __construct(
        ManagerRegistry $registry,
        PreviewResolverInterface $previewResolver,
        EventDispatcherInterface $dispatcher,
        Security $security,
    ) {
        parent::__construct($registry, $previewResolver, $dispatcher, $security, NSMenuLink::class);
    }
}
