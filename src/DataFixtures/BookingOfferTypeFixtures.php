<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BookingOfferType;
class BookingOfferTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $offerType = new BookingOfferType();
        $offerType->setTypeName('First Minute');
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('Last Minute');
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('All Inclusive');
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('For Children');
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('Group Tours');
        $manager->persist($offerType);

        $offerType = new BookingOfferType();
        $offerType->setTypeName('Cruises');
        $manager->persist($offerType);

        $manager->flush();
    }
}
