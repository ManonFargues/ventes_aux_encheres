<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    const USER_COUNT = 20;
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder) {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }


    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        $password = $this->userPasswordEncoder->encodePassword(new User(), 'password');
        $adminpassword = $this->userPasswordEncoder->encodePassword(new User(), 'admin');
    
        for($i = 0; $i < self::USER_COUNT; $i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($password);
            $manager->persist($user);
        }

        $admin = new User();
        $admin->setEmail($faker->email);
        $admin->setPassword($adminpassword);
        $manager->persist($admin);

        $manager->flush();
    }
}
