<?php

namespace App\Repository;

use App\Entity\CustomersRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomersRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomersRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomersRating[]    findAll()
 * @method CustomersRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomersRating::class);
    }

    // /**
    //  * @return CustomersRating[] Returns an array of CustomersRating objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomersRating
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAvgRatingForPackage($packageId): ?int{
        $qb = $this->createQueryBuilder('rating')
            ->andWhere('rating.package = :val')
            ->setParameter('val', $packageId);
        $result = $qb->getQuery()->getResult();
        $avg = 0;
        foreach ($result as $row)
            $avg+=$row->getRating();
        return round($avg/count($result));
    }
}
