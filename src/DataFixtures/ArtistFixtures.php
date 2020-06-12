<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArtistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artists = [
            ['firstname'=>'Daniel', 'lastname'=>'Marcelin', 'agent'=> 'Marcelin@gmail.com'],
            ['firstname'=>'Philippe', 'lastname'=>'Laurent', 'agent'=> 'Laurent@gmail.com'],
            ['firstname'=>'Marius', 'lastname'=>'Von Mayenburg', 'agent'=> 'Marcelin@gmail.com'],
            ['firstname'=>'Olivier', 'lastname'=>'Boudon', 'agent'=> 'Laurent@gmail.com'],
            ['firstname'=>'Anne Marie', 'lastname'=>'Loop', 'agent'=> 'Marcelin@gmail.com'],
            ['firstname'=>'Pietro', 'lastname'=>'Varasso', 'agent'=> 'Laurent@gmail.com'],
            ['firstname'=>'Laurent', 'lastname'=>'Caron', 'agent'=> 'Marcelin@gmail.com'],
            ['firstname'=>'Eléna', 'lastname'=>'Perez', 'agent'=> 'Von Mayenburg@gmail.com'],
            ['firstname'=>'Guillaume', 'lastname'=>'Alexandre'],
            ['firstname'=>'Claude', 'lastname'=>'Semal'],
            ['firstname'=>'Laurence', 'lastname'=>'Warin', 'agent'=> 'Marcelin@gmail.com'],
            ['firstname'=>'Pierre', 'lastname'=>'Wayburn'],
            ['firstname'=>'Gwendoline', 'lastname'=>'Gauthier', 'agent'=> 'Marcelin@gmail.com'],
 
        ];

        foreach($artists as $record){
            $artist = new Artist();
            $artist->setFirstname($record['firstname']);
            $artist->setLastname($record['lastname']);
          
            

            if(!empty($record['agent'])){
                $artist->setAgent($this->getReference($record['agent']));
            }
            $this->addReference($record['firstname']."-".$record['lastname'],$artist);

            $manager->persist($artist);
        }
           
            
        $manager->flush();
    }
    public function getDependencies() {
        return [
            AgentFixtures::class,
        ];
    }
}
