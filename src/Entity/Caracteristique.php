<?php

namespace App\Entity;

use App\Repository\CaracteristiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaracteristiqueRepository::class)
 */
class Caracteristique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_Acc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mois;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $an;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hrmn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $com;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $inte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $atm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $col;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAcc(): ?string
    {
        return $this->num_Acc;
    }

    public function setNumAcc(string $num_Acc): self
    {
        $this->num_Acc = $num_Acc;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAn(): ?string
    {
        return $this->an;
    }

    public function setAn(string $an): self
    {
        $this->an = $an;

        return $this;
    }

    public function getHrmn(): ?string
    {
        return $this->hrmn;
    }

    public function setHrmn(string $hrmn): self
    {
        $this->hrmn = $hrmn;

        return $this;
    }

    public function getLum(): ?string
    {
        return $this->lum;
    }

    public function setLum(string $lum): self
    {
        $this->lum = $lum;

        return $this;
    }

    public function getDep(): ?string
    {
        return $this->dep;
    }

    public function setDep(string $dep): self
    {
        $this->dep = $dep;

        return $this;
    }

    public function getCom(): ?string
    {
        return $this->com;
    }

    public function setCom(string $com): self
    {
        $this->com = $com;

        return $this;
    }

    public function getAgg(): ?string
    {
        return $this->agg;
    }

    public function setAgg(string $agg): self
    {
        $this->agg = $agg;

        return $this;
    }

    public function getInte(): ?string
    {
        return $this->inte;
    }

    public function setInte(string $inte): self
    {
        $this->inte = $inte;

        return $this;
    }

    public function getAtm(): ?string
    {
        return $this->atm;
    }

    public function setAtm(string $atm): self
    {
        $this->atm = $atm;

        return $this;
    }

    public function getCol(): ?string
    {
        return $this->col;
    }

    public function setCol(string $col): self
    {
        $this->col = $col;

        return $this;
    }

    public function getAdr(): ?string
    {
        return $this->adr;
    }

    public function setAdr(string $adr): self
    {
        $this->adr = $adr;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLongi(): ?string
    {
        return $this->longi;
    }

    public function setLongi(string $longi): self
    {
        $this->longi = $longi;

        return $this;
    }
}
