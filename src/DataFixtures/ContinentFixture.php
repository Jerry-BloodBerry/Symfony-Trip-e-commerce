<?php


namespace App\DataFixtures;

use App\Entity\Continent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContinentFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $manager->persist($this->createContinent('Africa'));
        $manager->persist($this->createContinent('Antarctica'));
        $manager->persist($this->createContinent('Asia'));
        $manager->persist($this->createContinent('Australia'));
        $manager->persist($this->createContinent('North America'));
        $manager->persist($this->createContinent('South America'));

        $manager->flush();
    }

    private function createContinent($name) : Continent
    {
        $continent = new Continent();
        $continent->setName($name);
        return $continent;
    }

}