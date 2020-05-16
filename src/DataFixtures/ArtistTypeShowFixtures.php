<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArtistTypeShowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artistTypeShows = [
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'auteur',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'scénographe',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'comédien',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            
        ];

        foreach($ats as $data) {
            $at = $this->getReference($data['artist_firstname']
                    .'-'.$data['artist_lastname']
                    .'-'.$data['type']);
            $show = $this->getReference($data['show_slug']);

            $show->addArtistType($at);

            $manager->persist($show);
        }
        
        $manager->flush();
    }
    
    public function getDependencies() {
        return [
            ArtistTypeFixtures::class,
            ShowFixtures::class,
        ];
    }
}
