<?php

namespace App\DataFixtures;

use App\Entity\BookingOffer;
use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookingOfferFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::SPAIN_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Summer n\' Chill',
            1520,
            4.5,
            new \DateTime('2020-11-23'),
            new \DateTime('2021-03-05'),
            new \DateTime('2021-03-06'),
            new \DateTime('2021-03-20'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::TURKEY_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Le famous Turk',
            1200,
            5.0,
            new \DateTime('2020-07-05'),
            new \DateTime('2021-02-05'),
            new \DateTime('2021-02-06'),
            new \DateTime('2021-02-20'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100,
            3.5,
            new \DateTime('2020-08-15'),
            new \DateTime('2021-01-15'),
            new \DateTime('2021-01-16'),
            new \DateTime('2021-01-23'),
            'Balice Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::JAPAN_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE),
            'R- Akasaka Onsen Resort',
            3550,
            4.8,
            new \DateTime('2020-05-05'),
            new \DateTime('2020-12-06'),
            new \DateTime('2020-12-07'),
            new \DateTime('2020-12-14'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::AUSTRALIA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::CRUISES_REFERENCE),
            'Y- Sydney\'s prime',
            2700,
            4.5,
            new \DateTime('2020-04-10'),
            new \DateTime('2020-12-10'),
            new \DateTime('2020-12-11'),
            new \DateTime('2020-12-18'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200,
            3.7,
            new \DateTime('2020-05-05'),
            new \DateTime('2020-12-05'),
            new \DateTime('2020-12-06'),
            new \DateTime('2020-12-20'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::THAILAND_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Buddha\'s way',
            1580,
            4.2,
            new \DateTime('2020-09-05'),
            new \DateTime('2021-02-05'),
            new \DateTime('2021-02-06'),
            new \DateTime('2021-02-20'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::CHINA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Bei-JING',
            1520,
            3.0,
            new \DateTime('2020-03-23'),
            new \DateTime('2020-06-05'),
            new \DateTime('2020-06-06'),
            new \DateTime('2020-06-20'),
            'Warsaw Chopin Airport'
        );
        $manager->persist($bookingOffer);

        $manager->flush();
    }

    private function createBookingOffer(Destination $destination, $offerType , $offerName, $offerPrice, $rating, $bookingStartDate, $bookingEndDate, $departureDate, $comebackDate, $departureSpot) : BookingOffer
    {
        $bookingOffer = new BookingOffer();
        $bookingOffer->setDestination($destination);
        $bookingOffer->setOfferType($offerType);
        $bookingOffer->setOfferName($offerName);
        $bookingOffer->setOfferPrice($offerPrice);
        $bookingOffer->setRating($rating);
        $bookingOffer->setBookingStartDate($bookingStartDate);
        $bookingOffer->setBookingEndDate($bookingEndDate);
        $bookingOffer->setDepartureDate($departureDate);
        $bookingOffer->setComebackDate($comebackDate);
        $bookingOffer->setDepartureSpot($departureSpot);
        return $bookingOffer;
    }

    public function getDependencies()
    {
        return [DestinationFixture::class, BookingOfferTypeFixtures::class];
    }
}
