<?php


namespace App\DataFixtures;

use App\Entity\Career;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CareerFixture extends Fixture
{

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $career = $this->createCareer(
            'manager',
            'Team management',
            '2 years experience',
            4500.00,
            new \DateTime('2020-11-22'),
            new \DateTime('2020-12-30')
        );
        $manager->persist($career);
        $career = $this->createCareer(
            'tour guide',
            'Tour guidance',
            'Student status',
            2000.00,
            new \DateTime('2020-11-22'),
            new \DateTime('2020-12-30')
        );
        $manager->persist($career);
        $manager->flush();
    }
    private function createCareer($job_title, $description, $requirements, $salary, $start_date, $end_date)
    {
        $career = new Career();
        $career->setJobTitle($job_title);
        $career->setDescription($description);
        $career->setRequirements($requirements);
        $career->setSalary($salary);
        $career->setStartDate($start_date);
        $career->setEndDate($end_date);
        return $career;
    }
}