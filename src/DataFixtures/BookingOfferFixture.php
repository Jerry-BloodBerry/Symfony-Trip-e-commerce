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
            [$this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE)],
            'H- Summer n\' Chill',
            1520,
            4.5
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::TURKEY_REFERENCE),
            [$this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE)],
            'H- Le famous Turk',
            1200,
            5.0
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            [$this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE)],
            'H- Maharaja\'s Rest',
            2100,
            3.5
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::JAPAN_REFERENCE),
            [$this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE)],
            'R- Akasaka Onsen Resort',
            3550,
            4.8
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::AUSTRALIA_REFERENCE),
            [
                $this->getReference(BookingOfferTypeFixtures::CRUISES_REFERENCE),
                $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
                $this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE)
            ],
            'Y- Sydney\'s prime',
            2700,
            4.5
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            [$this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE)],
            'H- Il Mafioso',
            1200,
            3.7
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::THAILAND_REFERENCE),
            [$this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE)],
            'H- Buddha\'s way',
            1580,
            4.2
        );
        $manager->persist($bookingOffer);
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::CHINA_REFERENCE),
            [
                $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
                $this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE)
            ],
            'H- Bei-JING',
            1520,
            3.0
        );
        $manager->persist($bookingOffer);

        $manager->flush();
    }

    private function createBookingOffer(Destination $destination, $offerTypes , $offerName, $offerPrice, $rating) : BookingOffer
    {
        $bookingOffer = new BookingOffer();
        $bookingOffer->setDestination($destination);
        foreach ($offerTypes as $offerType)
        {
            $bookingOffer->addOfferType($offerType);
        }
        $bookingOffer->setOfferName($offerName);
        $bookingOffer->setOfferPrice($offerPrice);
        $bookingOffer->setRating($rating);
        return $bookingOffer;
    }

    public function getDependencies()
    {
        return [DestinationFixture::class, BookingOfferTypeFixtures::class];
    }
}
