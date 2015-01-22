<?php

namespace BDDTutorial\WojtekSasielaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Towar
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Towar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nazwa", type="string", length=255)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="CenaJednostkowa", type="decimal")
     */
    private $cenaJednostkowa;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     * @return Towar
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set cenaJednostkowa
     *
     * @param string $cenaJednostkowa
     * @return Towar
     */
    public function setCenaJednostkowa($cenaJednostkowa)
    {
        $this->cenaJednostkowa = $cenaJednostkowa;

        return $this;
    }

    /**
     * Get cenaJednostkowa
     *
     * @return string 
     */
    public function getCenaJednostkowa()
    {
        return $this->cenaJednostkowa;
    }
}
