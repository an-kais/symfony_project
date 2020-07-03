<?php

namespace App\Repository;

use App\Entity\SubjLect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubjLect|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubjLect|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubjLect[]    findAll()
 * @method SubjLect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjLectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubjLect::class);
    }

    // /**
    //  * @return SubjLect[] Returns an array of SubjLect objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubjLect
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
