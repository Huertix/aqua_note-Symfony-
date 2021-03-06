<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $objects = Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );

//        $genus = new Genus();
//        $genus->setName('Octopus'.rand(1, 100));
//        $genus->setSubFamily('Octopodinae');
//        $genus->setSpeciesCount(rand(100, 99999));
//        $manager->persist($genus);
//        $manager->flush();
    }

    public function genus()
    {
        $genera = [
            'Octopus',
            'Balaena',
            'Orcinus',
            'Hippocampus',
            'Asterias',
            'Amphiprion',
            'Carcharodon',
            'Aurelia',
            'Cucumaria',
            'Balistoides',
            'Paralithodes',
            'Chelonia',
            'Trichechus',
            'Eumetopias'
        ];
        $key = array_rand($genera);
        return $genera[$key];
    }

    public function subFamily()
    {
        $genera = [
            'Barnacle',
            'Clownfish',
            'Dolphin',
            'Dugong',
            'Emperor Shrimp',
            'Flying Fish',
            'Giant Squid',
            'Haddock',
            'Isopods',
            'Killer Whale',
            'Lamprey',
            'Manatee',
            'Nudibranch',
            'Quahog'
        ];
        $key = array_rand($genera);
        return $genera[$key];
    }
}