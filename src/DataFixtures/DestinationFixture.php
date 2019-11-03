<?php

namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DestinationFixture extends Fixture
{
    public const SPAIN_REFERENCE = 'spain';
    public const TURKEY_REFERENCE = 'turkey';
    public const INDIA_REFERENCE = 'india';
    public const JAPAN_REFERENCE = 'japan';
    public const AUSTRALIA_REFERENCE = 'australia';
    public const NEW_ZEALAND_REFERENCE = 'new_zealand';
    public const ITALY_REFERENCE = 'italy';
    public const THAILAND_REFERENCE = 'thailand';
    public const CHINA_REFERENCE = 'china';
    public function load(ObjectManager $manager)
    {
        $destination = $this->createDestination('Spain');
        $manager->persist($destination);
        $this->addReference(self::SPAIN_REFERENCE,$destination);

        $destination = $this->createDestination('Turkey');
        $manager->persist($destination);
        $this->addReference(self::TURKEY_REFERENCE,$destination);

        $destination = $this->createDestination('India');
        $manager->persist($destination);
        $this->addReference(self::INDIA_REFERENCE,$destination);

        $destination = $this->createDestination('Japan');
        $manager->persist($destination);
        $this->addReference(self::JAPAN_REFERENCE,$destination);

        $destination = $this->createDestination('Australia');
        $manager->persist($destination);
        $this->addReference(self::AUSTRALIA_REFERENCE,$destination);

        $destination = $this->createDestination('New Zealand');
        $manager->persist($destination);
        $this->addReference(self::NEW_ZEALAND_REFERENCE,$destination);

        $destination = $this->createDestination('Italy');
        $manager->persist($destination);
        $this->addReference(self::ITALY_REFERENCE,$destination);

        $destination = $this->createDestination('Thailand');
        $manager->persist($destination);
        $this->addReference(self::THAILAND_REFERENCE,$destination);

        $destination = $this->createDestination('China');
        $manager->persist($destination);
        $this->addReference(self::CHINA_REFERENCE,$destination);

        $manager->flush();
    }

    private function createDestination($name) :Destination
    {
        $destination = new Destination();
        $destination->setDestinationName($name);
        return $destination;
    }
}
