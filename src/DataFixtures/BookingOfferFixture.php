<?php

namespace App\DataFixtures;

use App\Entity\BookingOffer;
use App\Entity\BookingOfferType;
use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class BookingOfferFixture extends Fixture implements DependentFixtureInterface
{
    public const SUMMER_CHILL_REFERENCE = 'H- Summer n\' Chill';
    public const FAMOUS_TURK_REFERENCE = 'H- Le famous Turk';
    public const MAHARAJA_REFERENCE1 = 'H- Maharaja\'s Rest1';
    public const MAHARAJA_REFERENCE2 = 'H- Maharaja\'s Rest2';
    public const AKASAKA_REFERENCE = 'R- Akasaka Onsen Resort';
    public const SYDNEY_REFERENCE = 'Y- Sydney\'s prime';
    public const MAFIOSO_REFERENCE1 = 'H- Il Mafioso1';
    public const MAFIOSO_REFERENCE2 = 'H- Il Mafioso2';
    public const BUDDHA_REFERENCE = 'H- Buddha\'s way';
    public const BEIJING_REFERENCE = 'H- Bei-JING';
    public const PATAGONIA_REFERENCE = 'H- Patagonia';

    public const ALL_ACCOMODATION_REFERENCES = [
        self::SUMMER_CHILL_REFERENCE,
        self::FAMOUS_TURK_REFERENCE,
        self::MAHARAJA_REFERENCE1,
        self::MAHARAJA_REFERENCE2,
        self::AKASAKA_REFERENCE,
        self::SYDNEY_REFERENCE,
        self::MAFIOSO_REFERENCE1,
        self::MAFIOSO_REFERENCE2,
        self::BUDDHA_REFERENCE,
        self::BEIJING_REFERENCE,
        self::PATAGONIA_REFERENCE
    ];

    private function getPackageIdForAccommodationReference(string $accommodationReference): int
    {
        switch ($accommodationReference) {
            case self::SUMMER_CHILL_REFERENCE:
                return 2;
            case self::FAMOUS_TURK_REFERENCE:
                return 3;
            case self::MAHARAJA_REFERENCE1:
                return 4;
            case self::MAHARAJA_REFERENCE2:
                return 5;
            case self::AKASAKA_REFERENCE:
                return 6;
            case self::SYDNEY_REFERENCE:
                return 7;
            case self::MAFIOSO_REFERENCE1:
                return 8;
            case self::MAFIOSO_REFERENCE2:
                return 9;
            case self::BUDDHA_REFERENCE:
                return 10;
            case self::BEIJING_REFERENCE:
                return 10;
            case self::PATAGONIA_REFERENCE:
                return 10;
            default:
                throw new \InvalidArgumentException('Unknown Accommodation Reference');
        }
    }

    public const DEPARTURE_COMEBACK_SPOTS = [
        'Warsaw Chopin Airport',
        'Balice Airport',
        'Modlin Airport'
    ];

    private readonly Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->faker->seed(1234);
    }

    public function load(ObjectManager $manager): void
    {
        // for ($i = 0; $i < 350; $i++) {
        //     $bookingOffer = $this->generateRandomBookingOffer($i < 3);
        //     try {
        //         $this->addReference($bookingOffer->getOfferName(), $bookingOffer);
        //     } catch (\BadMethodCallException) {
        //         // We ignore the BadMethodCallException as we need the references for the dependent fixtures
        //         // and don't care if we try to assign them again as longs as there is one successful assignment
        //     }
        //     $manager->persist($bookingOffer);
        // }
        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::SPAIN_REFERENCE),
            $this->faker->text(1000),
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Summer n\' Chill',
            1520.00,
            620.00,
            2,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::SUMMER_CHILL_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::TURKEY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Le famous Turk',
            1200.00,
            500.00,
            3,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::FAMOUS_TURK_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100.00,
            1800.00,
            4,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Balice Airport',
            'Balice Airport',
            false
        );
        $this->addReference(self::MAHARAJA_REFERENCE1, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::INDIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Maharaja\'s Rest',
            2100.00,
            1800.00,
            4,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::MAHARAJA_REFERENCE2, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::JAPAN_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::ALL_INCLUSIVE_REFERENCE),
            'R- Akasaka Onsen Resort',
            3550.00,
            3350.00,
            5,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::AKASAKA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::AUSTRALIA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::CRUISES_REFERENCE),
            'Y- Sydney\'s prime',
            2700.00,
            1900.00,
            6,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::SYDNEY_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200.00,
            980.00,
            7,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Modlin Airport',
            'Modlin Airport',
            false
        );
        $this->addReference(self::MAFIOSO_REFERENCE1, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ITALY_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Il Mafioso',
            1200.00,
            980.00,
            7,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Modlin Airport',
            'Modlin Airport',
            false
        );
        $this->addReference(self::MAFIOSO_REFERENCE2, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::THAILAND_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Buddha\'s way',
            1580.00,
            940.00,
            8,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            false
        );
        $this->addReference(self::BUDDHA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::CHINA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque autem cum delectus doloribus 
                      error eum facilis in itaque laudantium natus nesciunt odit, officia quasi ratione recusandae rem, rerum unde.
                      Beatae cumque debitis iure nihil officiis perferendis soluta unde! Alias animi iure maxime repudiandae. 
                      Assumenda atque blanditiis dolorum esse, expedita, ipsum iste laboriosam libero magnam, magni odit quae quos sed?',
            $this->getReference(BookingOfferTypeFixtures::LAST_MINUTE_REFERENCE),
            'H- Bei-JING',
            1520.00,
            800.00,
            9,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::BEIJING_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $bookingOffer = $this->createBookingOffer(
            $this->getReference(DestinationFixture::ARGENTINA_REFERENCE),
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate illo sequi soluta. 
                      Corporis, deserunt incidunt laboriosam magnam nemo nobis porro quae 
                      repellat repudiandae rerum? Consequatur eaque exercitationem nulla sed ut?',
            $this->getReference(BookingOfferTypeFixtures::FIRST_MINUTE_REFERENCE),
            'H- Patagonia',
            2800.00,
            2400.00,
            10,
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            'Warsaw Chopin Airport',
            'Warsaw Chopin Airport',
            true
        );
        $this->addReference(self::PATAGONIA_REFERENCE, $bookingOffer);
        $manager->persist($bookingOffer);

        $manager->flush();
    }

    private function createBookingOffer(
        Destination $destination,
        string $description,
        BookingOfferType $offerType,
        string $offerName,
        float $offerPrice,
        float $childPrice,
        int $packageId,
        \DateTime $bookingStartDate,
        \DateTime $bookingEndDate,
        \DateTime $departureDate,
        \DateTime $comebackDate,
        string $departureSpot,
        string $comebackSpot,
        bool $isFeatured
    ): BookingOffer {
        $bookingOffer = new BookingOffer();
        $bookingOffer
            ->setDestination($destination)
            ->setDescription($description)
            ->setOfferType($offerType)
            ->setOfferName($offerName)
            ->setOfferPrice($offerPrice)
            ->setChildPrice($childPrice)
            ->setPackageId($packageId)
            ->setBookingStartDate($bookingStartDate)
            ->setBookingEndDate($bookingEndDate)
            ->setDepartureDate($departureDate)
            ->setComebackDate($comebackDate)
            ->setDepartureSpot($departureSpot)
            ->setComebackSpot($comebackSpot)
            ->setIsFeatured($isFeatured)
            ->setPhotosDirectory('images/offers_cards/' . $packageId);

        return $bookingOffer;
    }

    private function generateRandomBookingOffer(bool $featured = false): BookingOffer
    {
        $bookingStartDate = $this->faker->dateTimeBetween('-1 year', 'now', 'UTC');
        $bookingEndDate = $this->faker->dateTimeBetween('now', '+1 year', 'UTC');
        $departureDate = $this->faker->dateTimeInInterval($bookingEndDate, '+1 month', 'UTC');
        $comebackDate = $this->faker->dateTimeInInterval($departureDate->add(new \DateInterval('P3D')), '+2 weeks', 'UTC');
        $departAndComebackSpot = $this->faker->randomElement(self::DEPARTURE_COMEBACK_SPOTS);
        $adultPrice = $this->faker->numberBetween(1500, 10000);
        $childPrice = $this->faker->numberBetween((int) (1 / 3 * $adultPrice), (int) (2 / 3 * $adultPrice));
        $accomodation = $this->faker->randomElement(self::ALL_ACCOMODATION_REFERENCES);
        return $this->createBookingOffer(
            $this->getReference($this->faker->randomElement(DestinationFixture::ALL_DESTINATIONS)),
            $this->faker->text(1000),
            $this->getReference($this->faker->randomElement(BookingOfferTypeFixtures::ALL_BOOKING_OFFER_TYPES)),
            $accomodation,
            $adultPrice,
            $childPrice,
            $this->getPackageIdForAccommodationReference($accomodation),
            $bookingStartDate,
            $bookingEndDate,
            $departureDate,
            $comebackDate,
            $departAndComebackSpot,
            $departAndComebackSpot,
            $featured
        );
    }

    public function getDependencies()
    {
        return [DestinationFixture::class, BookingOfferTypeFixtures::class];
    }
}
