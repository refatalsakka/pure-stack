<?php

namespace App\Repository;

use App\Entity\WorkValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkValue>
 */
class WorkValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkValue::class);
    }

    /**
     * @return WorkValue[]
     */
    public function findAllSortedBySort(): array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.sort', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
