<?php


namespace App\DataFixtures;

use App\Entity\Continent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContinentFixture extends Fixture
{
    public const AFRICA_REFERENCE = 'africa';
    public const ANTARCTICA_REFERENCE = 'antarctica';
    public const ASIA_REFERENCE = 'asia';
    public const AUSTRALIA_REFERENCE = 'australia';
    public const EUROPE_REFERENCE = 'europe';
    public const NORTH_AMERICA_REFERENCE = 'north america';
    public const SOUTH_AMERICA_REFERENCE = 'south america';
    public function load(ObjectManager $manager)
    {

        $continent = $this->createContinent('Africa');
        $manager->persist($continent);
        $this->addReference(self::AFRICA_REFERENCE,$continent);
        $continent = $this->createContinent('Antarctica');
        $manager->persist($continent);
        $this->addReference(self::ANTARCTICA_REFERENCE,$continent);
        $continent = $this->createContinent('Asia');
        $manager->persist($continent);
        $this->addReference(self::ASIA_REFERENCE,$continent);
        $continent = $this->createContinent('Australia');
        $manager->persist($continent);
        $this->addReference(self::AUSTRALIA_REFERENCE,$continent);
        $continent = $this->createContinent('Europe');
        $manager->persist($continent);
        $this->addReference(self::EUROPE_REFERENCE,$continent);
        $continent = $this->createContinent('North America');
        $manager->persist($continent);
        $this->addReference(self::NORTH_AMERICA_REFERENCE,$continent);
        $continent = $this->createContinent('South America');
        $manager->persist($continent);
        $this->addReference(self::SOUTH_AMERICA_REFERENCE,$continent);

        $manager->flush();
    }

    private function createContinent($name) : Continent
    {
        $continent = new Continent();
        $continent->setName($name);
        return $continent;
    }

}