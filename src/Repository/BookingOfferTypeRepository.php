<?php

namespace App\Repository;

use App\Entity\BookingOfferType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BookingOfferType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingOfferType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingOfferType[]    findAll()
 * @method BookingOfferType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingOfferTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingOfferType::class);
    }

    // /**
    //  * @return BookingOfferType[] Returns an array of BookingOfferType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingOfferType
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
