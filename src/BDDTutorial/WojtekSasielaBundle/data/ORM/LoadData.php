<?php

namespace Gajdaw\BDDTutorial\WojtekSasielaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Yaml\Yaml;

use Gajdaw\BDDTutorial\WojtekSasielaBundle\Entity\Towar;
use Gajdaw\BDDTutorial\WojtekSasielaBundle\Entity\Dostawa;
use Gajdaw\BDDTutorial\WojtekSasielaBundle\Entity\Zamowienia;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $filename = __DIR__ . '/../../data/towary.yml';
        $yml = Yaml::parse(file_get_contents($filename));
        // towary
        foreach ($yml as $item) {
            $towary = new Towar();
            $towary->setsetnazwa($item['Nazwa']);
            $towary->setCenaJednostkowa($item['CenaJednostkowa']);
            $manager->persist($towary);
        }
        //dostawy
        foreach ($yml as $item) {
            $dostawa = new Dostawa();
            $dostawa->setnazwa($item['Nazwa']);
            $dostawa->setCenaJednostkowa($item['CenaJednostkowa']);
            $manager->persist($dostawa);
        }
        //zamowienia
        foreach ($yml as $item) {
            $zamowienia = new Zamowienia();
            $zamowienia->setnazwa($item['Nazwa']);
            $zamowienia->setCenaJednostkowa($item['CenaJednostkowa']);
            $manager->persist($zamowienia);
        }

        $manager->flush();
    }
}