<?php

namespace App\Entity;

use OpenApi\Annotations as OA;


use Doctrine\ORM\Mapping as ORM;

/**
 * @OA\Schema()
 * @ORM\Entity(repositoryClass=CaracteristiqueRepository::class)

 */
class Caracteristique
{
    /**
     * @OA\Property(type="integer", description="Identifiant de la caracteristique")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @OA\Property(type="integer", description="Numéro d'accident")
     * @ORM\Column(type="bigint")
     */
    private $num_acc;

    /**
     * @OA\Property(type="integer", description="jour de l'accident")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jour;

    /**
     * @OA\Property(type="integer", description="mois de l'accident")
     * @ORM\Column(type="integer")
     */
    private $mois;

    /**
     * @OA\Property(type="integer", description="année de l'accident")
     * @ORM\Column(type="integer")
     */
    private $an;

    /**
     * @OA\Property(type="string", description="heure de l'accident")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hrmn;

    /**
     * @OA\Property(type="integer", description="lumière au moment de l'accident")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lum;

    /**
     * @OA\Property(type="integer", description="departement de l'accident")
     * @ORM\Column(type="integer")
     */
    private $dep;

    /**
     * @OA\Property(type="integer", description="localisation: agglo / hors-agglo")
     * @ORM\Column(type="integer")
     */
    private $agg;

    /**
     * @OA\Property(type="integer", description="type d'intersection")
     * @ORM\Column(type="integer")
     */
    private $inte;

    /**
     * @OA\Property(type="integer", description="condition météo")
     * @ORM\Column(type="integer")
     */
    private $atm;

    /**
     * @OA\Property(type="integer", description="type de collision")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $col;

    /**
     * @OA\Property(type="string", description="adresse postal de l'accident")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adr;

    /**
     * @OA\Property(type="integer", description="latitude de l'accident")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lat;

    /**
     * @OA\Property(type="integer", description="longitude de l'accident")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longi;

    /**
     * @OA\Property(type="integer", description="commune de l'accident")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $com;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAcc(): ?int
    {
        return $this->num_acc;
    }

    public function setNumAcc(int $num_acc): self
    {
        $this->num_acc = $num_acc;

        return $this;
    }

    public function getJour(): ?int
    {
        return $this->jour;
    }

    public function setJour(?int $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getMois(): ?int
    {
        return $this->mois;
    }

    public function setMois(int $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAn(): ?int
    {
        return $this->an;
    }

    public function setAn(int $an): self
    {
        $this->an = $an;

        return $this;
    }

    public function getHrmn(): ?string
    {
        return $this->hrmn;
    }

    public function setHrmn(?string $hrmn): self
    {
        $this->hrmn = $hrmn;

        return $this;
    }

    public function getLum(): ?int
    {
        return $this->lum;
    }

    public function setLum(?int $lum): self
    {
        $this->lum = $lum;

        return $this;
    }

    public function getDep(): ?int
    {
        return $this->dep;
    }

    public function setDep(int $dep): self
    {
        $this->dep = $dep;

        return $this;
    }

    public function getAgg(): ?int
    {
        return $this->agg;
    }

    public function setAgg(int $agg): self
    {
        $this->agg = $agg;

        return $this;
    }

    public function getInte(): ?int
    {
        return $this->inte;
    }

    public function setInte(int $inte): self
    {
        $this->inte = $inte;

        return $this;
    }

    public function getAtm(): ?int
    {
        return $this->atm;
    }

    public function setAtm(int $atm): self
    {
        $this->atm = $atm;

        return $this;
    }

    public function getCol(): ?int
    {
        return $this->col;
    }

    public function setCol(?int $col): self
    {
        $this->col = $col;

        return $this;
    }

    public function getAdr(): ?string
    {
        return $this->adr;
    }

    public function setAdr(?string $adr): self
    {
        $this->adr = $adr;

        return $this;
    }

    public function getLat(): ?int
    {
        return $this->lat;
    }

    public function setLat(?int $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLongi(): ?int
    {
        return $this->longi;
    }

    public function setLongi(?int $longi): self
    {
        $this->longi = $longi;

        return $this;
    }

    public function getCom(): ?int
    {
        return $this->com;
    }

    public function setCom(?int $com): self
    {
        $this->com = $com;

        return $this;
    }
}
