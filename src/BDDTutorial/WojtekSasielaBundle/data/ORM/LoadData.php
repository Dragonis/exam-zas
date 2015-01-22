<?php

namespace Gajdaw\BDDTutorial\WojtekSasielaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Yaml\Yaml;

use Gajdaw\BDDTutorial\WojtekSasielaBundle\Entity\Towar;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $filename = __DIR__ . '/../../data/towary.yml';
        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $towary = new Towar();
            $towary->setnazwa($item['Nazwa']);
            $towary->setCenaJednostkowa($item['CenaJednostkowa']);
            $manager->persist($towary);
        }

        $manager->flush();
    }
}