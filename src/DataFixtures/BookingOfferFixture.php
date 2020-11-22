<?php

namespace App\DataFixtures;

use App\Entity\BookingOffer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookingOfferFixture extends Fixture implements DependentFixtureInterface
{
    public const SUMMER_CHILL_REFERENCE = 'H- Summer n\' Chill';
    public const FAMOUS_TURK_REFERENCE = 'H- Le famous Turk';
    public const MAHARAJA_REFERENCE = 'H- Maharaja\'s Rest';
    public const AKASAKA_REFERENCE = 'R- Akasaka Onsen Resort';
    public const SYDNEY_REFERENCE = 'Y- Sydney\'s prime';
    public const MAFIOSO_REFERENCE = 'H- Il Mafioso';
    public const BUDDHA_REFERENCE = 'H- Buddha\'s way';
    public const BEIJING_REFERENCE = 'H- Bei-JING';
    public const PATAGONIA_REFERENCE = 'H- Patagonia';
    public function load(ObjectManager $manager)
    {
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::SPAIN_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Summer n\' Chill',
            1520,
            new \DateTime('2020-11-23'),
            new \DateTime('2021-03-05'),
            new \DateTime('2021-03-06'),
            new \DateTime('2021-03-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::SUMMER_CHILL_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::TURKEY_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Le famous Turk',
            1200,
            new \DateTime('2020-07-05'),
            new \DateTime('2021-02-05'),
            new \DateTime('2021-02-06'),
            new \DateTime('2021-02-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::FAMOUS_TURK_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100,
            new \DateTime('2020-08-15'),
            new \DateTime('2021-01-15'),
            new \DateTime('2021-01-16'),
            new \DateTime('2021-01-23'),
            'Balice Airport',
            'Balice Airport',
            false
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::MAHARAJA_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::JAPAN_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE),
            'R- Akasaka Onsen Resort',
            3550,
            new \DateTime('2020-05-05'),
            new \DateTime('2020-12-06'),
            new \DateTime('2020-12-07'),
            new \DateTime('2020-12-14'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::AKASAKA_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::AUSTRALIA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::CRUISES_REFERENCE),
            'Y- Sydney\'s prime',
            2700,
            new \DateTime('2020-04-10'),
            new \DateTime('2020-12-10'),
            new \DateTime('2020-12-11'),
            new \DateTime('2020-12-18'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::SYDNEY_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200,
            new \DateTime('2020-05-05'),
            new \DateTime('2020-12-05'),
            new \DateTime('2020-12-06'),
            new \DateTime('2020-12-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::MAFIOSO_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::THAILAND_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Buddha\'s way',
            1580,
            new \DateTime('2020-09-05'),
            new \DateTime('2021-02-05'),
            new \DateTime('2021-02-06'),
            new \DateTime('2021-02-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::BUDDHA_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::CHINA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Bei-JING',
            1520,
            new \DateTime('2020-11-10'),
            new \DateTime('2021-01-05'),
            new \DateTime('2021-06-06'),
            new \DateTime('2021-06-20'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::BEIJING_REFERENCE,$bookingOffer);

        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ARGENTINA_REFERENCE),
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Patagonia',
            2800,
            new \DateTime('2020-11-22'),
            new \DateTime('2021-04-05'),
            new \DateTime('2021-05-06'),
            new \DateTime('2021-05-25'),
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $manager->persist($bookingOffer);
        $this->addReference(self::PATAGONIA_REFERENCE,$bookingOffer);

        $manager->flush();
    }

    private function createBookingOffer($destination, $offerType , $offerName, $offerPrice, $bookingStartDate, $bookingEndDate, $departureDate, $comebackDate, $departureSpot, $comebackSpot, $isFeatured) : BookingOffer
    {
        $bookingOffer = new BookingOffer();
        $bookingOffer->setDestination($destination);
        $bookingOffer->setOfferType($offerType);
        $bookingOffer->setOfferName($offerName);
        $bookingOffer->setOfferPrice($offerPrice);
        $bookingOffer->setBookingStartDate($bookingStartDate);
        $bookingOffer->setBookingEndDate($bookingEndDate);
        $bookingOffer->setDepartureDate($departureDate);
        $bookingOffer->setComebackDate($comebackDate);
        $bookingOffer->setDepartureSpot($departureSpot);
        $bookingOffer->setComebackSpot($comebackSpot);
        $bookingOffer->setIsFeatured($isFeatured);
        return $bookingOffer;
    }

    public function getDependencies()
    {
        return [DestinationFixture::class, BookingOfferTypeFixtures::class];
    }
}
