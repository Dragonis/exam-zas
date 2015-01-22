<?php

namespace BDDTutorial\WojtekSasielaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zamowienia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Zamowienia
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
     * @ORM\Column(name="NazwaTowaru", type="string", length=255)
     */
    private $nazwaTowaru;

    /**
     * @var integer
     *
     * @ORM\Column(name="Ilosc", type="integer")
     */
    private $ilosc;


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
     * Set nazwaTowaru
     *
     * @param string $nazwaTowaru
     * @return Zamowienia
     */
    public function setNazwaTowaru($nazwaTowaru)
    {
        $this->nazwaTowaru = $nazwaTowaru;

        return $this;
    }

    /**
     * Get nazwaTowaru
     *
     * @return string 
     */
    public function getNazwaTowaru()
    {
        return $this->nazwaTowaru;
    }

    /**
     * Set ilosc
     *
     * @param integer $ilosc
     * @return Zamowienia
     */
    public function setIlosc($ilosc)
    {
        $this->ilosc = $ilosc;

        return $this;
    }

    /**
     * Get ilosc
     *
     * @return integer 
     */
    public function getIlosc()
    {
        return $this->ilosc;
    }
}
