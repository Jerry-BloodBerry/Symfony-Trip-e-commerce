<?php

namespace App\Repository;

use App\Entity\BookingOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
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

    private static function createSearchCriteria($departureSpot = null, $destination = null, $departureDate = null, $comebackDate = null, $priceMin = null, $priceMax = null)
    {
        $criteria = new Criteria();
        if($departureSpot != null)
            $criteria->andWhere(Criteria::expr()->eq('departureSpot', $departureSpot));
        if($destination != null)
            $criteria->andWhere(Criteria::expr()->eq('destination', $destination));
        if($departureDate != null)
            $criteria->andWhere(Criteria::expr()->gte('departureDate', $departureDate));
        if($comebackDate != null)
            $criteria->andWhere(Criteria::expr()->lte('comebackDate', $comebackDate));
        if($priceMin != null)
            $criteria->andWhere(Criteria::expr()->gte('offerPrice', $priceMin));
        if($priceMax != null)
            $criteria->andWhere(Criteria::expr()->lte('offerPrice', $priceMax));
        return $criteria;
    }

    public function findOffers($departureSpot = null, $destination = null, $departureDate = null, $comebackDate = null, $priceMin = null, $priceMax = null)
    {
        $qb = $this->createQueryBuilder('offer')->addCriteria(self::createSearchCriteria(
            $departureSpot,
            $destination,
            $departureDate,
            $comebackDate,
            $priceMin,
            $priceMax));
        return $qb->getQuery()->getResult();
    }
}
