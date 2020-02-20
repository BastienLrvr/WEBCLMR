<?php

namespace App\Repository;

use App\Entity\TypeFact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeFact|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeFact|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeFact[]    findAll()
 * @method TypeFact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeFactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeFact::class);
    }

    // /**
    //  * @return TypeFact[] Returns an array of TypeFact objects
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
    public function findOneBySomeField($value): ?TypeFact
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
