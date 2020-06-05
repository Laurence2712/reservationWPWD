<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\ArtistType;

class ArtistTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artistTypes = [
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' => 'comédien',
            ],
            
        ];

        foreach($artistTypes as $record) {
            $artist = $this->getReference($record['artist_firstname'].'-'.$record['artist_lastname']);
            $type = $this->getReference($record['type']);
            
            $artistType = new ArtistType();
            $artistType->setArtist($artist);
            $artistType->setType($type);
            
            $this->addReference($record['artist_firstname']
                    .'-'.$record['artist_lastname']
                    .'-'.$record['type'],$artistType);
            
            $manager->persist($artistType); 
        }
        
        $manager->flush();
    }

    public function getDependencies(){
        return [
            ArtistFixtures::class,
            TypeFixtures::class,
        ];
    }
}
