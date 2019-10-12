<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = $this->createUser('Jan', 'Kowalski', 'jan_kowalski@dreamholiday.com');
        $manager->persist($user1);
        $user2 = $this->createUser('John', 'Cena', 'john_cena@holidaydream.com');
        $manager->persist($user2);
        $admin = $this->createAdmin('Jacob', 'Ćwikowski', 'kcwikowski007@gmail.com');
        $manager->persist($admin);
        $manager->flush();

    }

    private function createUser(string $firstName, string $lastName, string $email): User
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setPassword('password');
        $user->setRegistrationDate(new \DateTime('now'));
        return $user;
    }

    private function createAdmin(string $firstName, string $lastName, string $email): User
    {
        $admin = $this->createUser($firstName, $lastName, $email);
        $admin->addRole('ROLE_ADMIN');
        return $admin;
    }
}
