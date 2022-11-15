<?php

namespace App\Entity;

use App\Repository\UsagersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsagersRepository::class)
 */
class Usagers
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
    private $id_vehicule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_veh;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grav;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $an_nais;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $trajet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secu1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secu2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secu3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $actp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etatp;




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

    public function getIdVehicule(): ?string
    {
        return $this->id_vehicule;
    }

    public function setIdVehicule(string $id_vehicule): self
    {
        $this->id_vehicule = $id_vehicule;

        return $this;
    }

    public function getNumVeh(): ?string
    {
        return $this->num_veh;
    }

    public function setNumVeh(string $num_veh): self
    {
        $this->num_veh = $num_veh;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getCatu(): ?string
    {
        return $this->catu;
    }

    public function setCatu(string $catu): self
    {
        $this->catu = $catu;

        return $this;
    }

    public function getGrav(): ?string
    {
        return $this->grav;
    }

    public function setGrav(string $grav): self
    {
        $this->grav = $grav;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAnNais(): ?string
    {
        return $this->an_nais;
    }

    public function setAnNais(string $an_nais): self
    {
        $this->an_nais = $an_nais;

        return $this;
    }

    public function getTrajet(): ?string
    {
        return $this->trajet;
    }

    public function setTrajet(string $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getSecu1(): ?string
    {
        return $this->secu1;
    }

    public function setSecu1(string $secu1): self
    {
        $this->secu1 = $secu1;

        return $this;
    }

    public function getSecu2(): ?string
    {
        return $this->secu2;
    }

    public function setSecu2(string $secu2): self
    {
        $this->secu2 = $secu2;

        return $this;
    }

    public function getSecu3(): ?string
    {
        return $this->secu3;
    }

    public function setSecu3(string $secu3): self
    {
        $this->secu3 = $secu3;

        return $this;
    }

    public function getLocp(): ?string
    {
        return $this->locp;
    }

    public function setLocp(string $locp): self
    {
        $this->locp = $locp;

        return $this;
    }

    public function getActp(): ?string
    {
        return $this->actp;
    }

    public function setActp(string $actp): self
    {
        $this->actp = $actp;

        return $this;
    }

    public function getEtatp(): ?string
    {
        return $this->etatp;
    }

    public function setEtatp(string $etatp): self
    {
        $this->etatp = $etatp;

        return $this;
    }
}
