<?php

/**
 * THIS IS A GENERATED FILE, DO NOT EDIT IT.
 * IT WILL BE RECREATED AT EACH NODE-TYPE UPDATE.
 */

declare(strict_types=1);

namespace App\GeneratedEntity\Repository;

use App\GeneratedEntity\NSAliasBlock;
use Doctrine\Persistence\ManagerRegistry;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Entity\Node;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\Roadiz\CoreBundle\Repository\NodesSourcesRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @extends NodesSourcesRepository<NSAliasBlock>
 * @method NSAliasBlock|null   find($id, $lockMode = null, $lockVersion = null)
 * @method NSAliasBlock|null   findOneBy(array $criteria, array $orderBy = null)
 * @method NSAliasBlock[]      findAll()
 * @method NSAliasBlock[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method NSAliasBlock|null   findOneByIdentifierAndTranslation(string $identifier, ?TranslationInterface $translation, bool $availableTranslation = false)
 * @method NSAliasBlock|null   findOneByNodeAndTranslation(Node $node, ?TranslationInterface $translation)
 * @method NSAliasBlock[]|null findByNodesSourcesAndFieldNameAndTranslation(NodesSources $nodesSources, string $fieldName, array $nodeSourceClasses = [])
 * @method int countBy(mixed $criteria)
 */
class NSAliasBlockRepository extends NodesSourcesRepository
{
    public function __construct(
        ManagerRegistry $registry,
        PreviewResolverInterface $previewResolver,
        EventDispatcherInterface $dispatcher,
        Security $security,
    ) {
        parent::__construct($registry, $previewResolver, $dispatcher, $security, NSAliasBlock::class);
    }
}
