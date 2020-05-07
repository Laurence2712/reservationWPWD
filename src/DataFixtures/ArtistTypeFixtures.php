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
        $artistType = [
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

        foreach($artistType as $record){
            $artist = $this->getReference(
                $record['artist_firstname'].'-'.$record['artist_lastname']
            );

            $type = $this->getReference($record['type']);

            $at = new ArtistType();
            $at->setArtist($artist);
            $at->setType($type);


            $manager->persist($at);
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
