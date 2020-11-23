<?php

namespace App\Repository;

use App\Entity\TestDavid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestDavid|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestDavid|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestDavid[]    findAll()
 * @method TestDavid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestDavidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestDavid::class);
    }

    // /**
    //  * @return TestDavid[] Returns an array of TestDavid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestDavid
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
