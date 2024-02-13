<?php

namespace App\Repository;

use App\Entity\Brand2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Brand2>
 *
 * @method Brand2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand2[]    findAll()
 * @method Brand2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Brand2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand2::class);
    }

//    /**
//     * @return Brand2[] Returns an array of Brand2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Brand2
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
