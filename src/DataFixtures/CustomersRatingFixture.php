<?php


namespace App\DataFixtures;

use App\Entity\CustomersRating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CustomersRatingFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rating = $this->createRating(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::PATAGONIA_REFERENCE),
            5.0
        );
        $manager->persist($rating);
        $rating = $this->createRating(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::PATAGONIA_REFERENCE),
            5.0
        );
        $manager->persist($rating);
        $rating = $this->createRating(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::BEIJING_REFERENCE),
            4.0
        );
        $manager->persist($rating);
        $rating = $this->createRatingWithComment(
            $this->getReference(UserFixture::USER1_REFERENCE),
            $this->getReference(BookingOfferFixture::MAHARAJA_REFERENCE),
            4.5,
            'Great tour'
        );
        $manager->persist($rating);
        $rating = $this->createRatingWithComment(
            $this->getReference(UserFixture::USER2_REFERENCE),
            $this->getReference(BookingOfferFixture::BEIJING_REFERENCE),
            3.0,
            'Accommodation could have been better'
        );
        $manager->persist($rating);

        $manager->flush();
    }

    private function createRating($user, $bookingOffer, $rating) :CustomersRating
    {
        $customersRating = new CustomersRating();
        $customersRating->getUser($user);
        $customersRating->setBookingOffer($bookingOffer);
        $customersRating->setRating($rating);
        return $customersRating;
    }

    private function createRatingWithComment($user, $bookingOffer, $rating, $comment) :CustomersRating
    {
        $customersRating= $this->createRating($user, $bookingOffer, $rating);
        $customersRating->setComment($comment);
        return $customersRating;
    }

    public function getDependencies()
    {
        return [UserFixture::class, BookingOfferFixtures::class];
    }
}