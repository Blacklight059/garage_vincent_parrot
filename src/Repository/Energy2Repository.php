<?php

namespace App\Repository;

use App\Entity\Energy2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Energy2>
 *
 * @method Energy2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Energy2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Energy2[]    findAll()
 * @method Energy2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Energy2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Energy2::class);
    }

//    /**
//     * @return Energy2[] Returns an array of Energy2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Energy2
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
