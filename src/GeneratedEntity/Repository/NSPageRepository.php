<?php

/**
 * THIS IS A GENERATED FILE, DO NOT EDIT IT.
 * IT WILL BE RECREATED AT EACH NODE-TYPE UPDATE.
 */

declare(strict_types=1);

namespace App\GeneratedEntity\Repository;

use App\GeneratedEntity\NSPage;
use Doctrine\Persistence\ManagerRegistry;
use RZ\Roadiz\Core\AbstractEntities\TranslationInterface;
use RZ\Roadiz\CoreBundle\Entity\Node;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\Roadiz\CoreBundle\Preview\PreviewResolverInterface;
use RZ\Roadiz\CoreBundle\Repository\NodesSourcesRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @extends NodesSourcesRepository<NSPage>
 * @method NSPage|null   find($id, $lockMode = null, $lockVersion = null)
 * @method NSPage|null   findOneBy(array $criteria, array $orderBy = null)
 * @method NSPage[]      findAll()
 * @method NSPage[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method NSPage|null   findOneByIdentifierAndTranslation(string $identifier, ?TranslationInterface $translation, bool $availableTranslation = false)
 * @method NSPage|null   findOneByNodeAndTranslation(Node $node, ?TranslationInterface $translation)
 * @method NSPage[]|null findByNodesSourcesAndFieldNameAndTranslation(NodesSources $nodesSources, string $fieldName, array $nodeSourceClasses = [])
 * @method int countBy(mixed $criteria)
 */
class NSPageRepository extends NodesSourcesRepository
{
    public function __construct(
        ManagerRegistry $registry,
        PreviewResolverInterface $previewResolver,
        EventDispatcherInterface $dispatcher,
        Security $security,
    ) {
        parent::__construct($registry, $previewResolver, $dispatcher, $security, NSPage::class);
    }
}
