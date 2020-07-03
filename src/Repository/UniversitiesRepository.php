<?php

namespace App\Repository;

use App\Entity\Universities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Universities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Universities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Universities[]    findAll()
 * @method Universities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniversitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Universities::class);
    }

    // /**
    //  * @return Universities[] Returns an array of Universities objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Universities
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
