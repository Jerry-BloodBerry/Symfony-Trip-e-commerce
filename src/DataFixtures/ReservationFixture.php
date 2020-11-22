<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ReservationFixture extends Fixture implements DependentFixtureInterface
{

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $reservation = $this->createReservation(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::BEIJING_REFERENCE),
            new \DateTime('2020-11-22')
        );
        $manager->persist($reservation);

        $reservation = $this->createPaidReservation(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::PATAGONIA_REFERENCE),
            new \DateTime('2020-11-22'),
            new \DateTime('2020-11-24')
        );
        $manager->persist($reservation);

        $reservation = $this->createReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::PATAGONIA_REFERENCE),
            new \DateTime('2020-11-23')
        );
        $manager->persist($reservation);

        $reservation = $this->createPaidReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::BEIJING_REFERENCE),
            new \DateTime('2020-11-22'),
            new \DateTime('2020-11-22')
        );
        $manager->persist($reservation);

        $reservation = $this->createReservation(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::MAHARAJA_REFERENCE),
            new \DateTime('2020-11-22')
        );
        $manager->persist($reservation);

        $manager->flush();
    }

    private function createReservation($user, $bookingOffer, $dateOfBooking, $paid=false) : Reservation
    {
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setBookingOffer($bookingOffer);
        $reservation->setDateOfBooking($dateOfBooking);
        $reservation->setPaid($paid);
        return $reservation;
    }

    private function createPaidReservation($user, $bookingOffer, $dateOfBooking, $bankTransferDate) : Reservation
    {
        $reservation = $this->createReservation($user, $bookingOffer, $dateOfBooking, true);
        $reservation->setBankTransferDate($bankTransferDate);
        return $reservation;
    }

    public function getDependencies()
    {
        return [UserFixture::class, BookingOfferFixtures::class];
    }
}