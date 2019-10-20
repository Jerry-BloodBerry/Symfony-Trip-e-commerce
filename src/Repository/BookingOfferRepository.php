<?php

namespace App\Repository;

use App\Entity\BookingOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BookingOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingOffer[]    findAll()
 * @method BookingOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingOffer::class);
    }

    // /**
    //  * @return BookingOffer[] Returns an array of BookingOffer objects
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
    public function findOneBySomeField($value): ?BookingOffer
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
