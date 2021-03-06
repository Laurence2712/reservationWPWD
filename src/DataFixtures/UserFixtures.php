<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder; 

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'login' => 'bob',
                'password' => 'epfc',
                'firstname' => 'Bob',
                'lastname' => 'Sull',
                'email' => 'bob@sull.com',
                'langue' => 'fr',
            ],
            [
                'login' => 'fred',
                'password' => 'epfc',
                'firstname' => 'Fred',
                'lastname' => 'Astrair',
                'email' => 'fred@sull.com',
                'langue' => 'en',
            ],
            [
                'login' => 'judith',
                'password' => 'epfc',
                'firstname' => 'Judith',
                'lastname' => 'Larson',
                'email' => 'judith@sull.com',
                'langue' => 'fr',
            ],
            
        ];
        foreach($users as $record) {

            $user = new User();
            //$encoder = new UserPasswordEncoder();
            //$password = $encoder->encode($user, $record['password'] );

            $user->setLogin($record['login']);
            $user->setPassword($record['password']);
            $user->setFirstname($record['firstname']);
            $user->setLastname($record['lastname']);
            $user->setEmail($record['email']);
            $user->setLangue($record['langue']);
           
            $this->addReference($record['login'], $user);
            
            $manager->persist($user);          
            
        }

        $manager->flush();
    }
}
