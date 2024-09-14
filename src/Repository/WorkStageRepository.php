<?php

namespace App\Repository;

use App\Entity\WorkStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkStage>
 */
class WorkStageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkStage::class);
    }

    /**
     * @return WorkStage[]
     */
    public function findAllSortedBySort(): array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.sort', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
