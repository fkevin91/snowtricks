<?php

namespace App\Repository;

use App\Entity\Snowtricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Snowtricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Snowtricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Snowtricks[]    findAll()
 * @method Snowtricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SnowtricksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Snowtricks::class);
    }

    // /**
    //  * @return Snowtricks[] Returns an array of Snowtricks objects
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
    public function findOneBySomeField($value): ?Snowtricks
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
