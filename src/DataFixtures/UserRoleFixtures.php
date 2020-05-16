<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\Datafixtures\DependentFixtureInterface;

class UserRoleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userRoles = [
            [
                'user_id' => 'bob',
                'role_id' => 'admin',
                
            ],
            [
                'user_id' => 'fred',
                'role_id' => 'membre',
                
            ],
            [
                'user_id' => 'judith',
                'role_id' => 'affiliate',
                
            ],
            
        ];

        foreach($userRoles as $record){
            $user = $this->getReference($record['user_login']);
            $role = $this->getReference($record['role']);

            $user->addRole($role);
            $manager->persist($user);
        }

        $manager->flush();
    }
    public function getDependencies(){
        return [
            UserFixtures::class,
            RoleFixtures::class,
        ];
    }
}
