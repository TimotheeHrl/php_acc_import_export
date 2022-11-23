<?php

namespace App\Entity;

use App\Repository\UsagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=UsagerRepository::class)

 */
class Usager
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $num_acc;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_vehicule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_veh;

    /**
     * @ORM\Column(type="integer")
     */
    private $place;

    /**
     * @ORM\Column(type="integer")
     */
    private $catu;

    /**
     * @ORM\Column(type="integer")
     */
    private $grav;

    /**
     * @ORM\Column(type="integer")
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $an_nais;

    /**
     * @ORM\Column(type="integer")
     */
    private $trajet;

    /**
     * @ORM\Column(type="integer")
     */
    private $secu1;

    /**
     * @ORM\Column(type="integer")
     */
    private $secu2;

    /**
     * @ORM\Column(type="integer")
     */
    private $secu3;

    /**
     * @ORM\Column(type="integer")
     */
    private $locp;

    /**
     * @ORM\Column(type="integer")
     */
    private $actp;

    /**
     * @ORM\Column(type="integer")
     */
    private $etatp;


    public function __construct()
    {
        $this->accident = new ArrayCollection();
    }

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

    public function getIdVehicule(): ?int
    {
        return $this->id_vehicule;
    }

    public function setIdVehicule(int $id_vehicule): self
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

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getCatu(): ?int
    {
        return $this->catu;
    }

    public function setCatu(int $catu): self
    {
        $this->catu = $catu;

        return $this;
    }

    public function getGrav(): ?int
    {
        return $this->grav;
    }

    public function setGrav(int $grav): self
    {
        $this->grav = $grav;

        return $this;
    }

    public function getSexe(): ?int
    {
        return $this->sexe;
    }

    public function setSexe(int $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAnNais(): ?int
    {
        return $this->an_nais;
    }

    public function setAnNais(int $an_nais): self
    {
        $this->an_nais = $an_nais;

        return $this;
    }

    public function getTrajet(): ?int
    {
        return $this->trajet;
    }

    public function setTrajet(int $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getSecu1(): ?int
    {
        return $this->secu1;
    }

    public function setSecu1(int $secu1): self
    {
        $this->secu1 = $secu1;

        return $this;
    }

    public function getSecu2(): ?int
    {
        return $this->secu2;
    }

    public function setSecu2(int $secu2): self
    {
        $this->secu2 = $secu2;

        return $this;
    }

    public function getSecu3(): ?int
    {
        return $this->secu3;
    }

    public function setSecu3(int $secu3): self
    {
        $this->secu3 = $secu3;

        return $this;
    }

    public function getLocp(): ?int
    {
        return $this->locp;
    }

    public function setLocp(int $locp): self
    {
        $this->locp = $locp;

        return $this;
    }

    public function getActp(): ?int
    {
        return $this->actp;
    }

    public function setActp(int $actp): self
    {
        $this->actp = $actp;

        return $this;
    }

    public function getEtatp(): ?int
    {
        return $this->etatp;
    }

    public function setEtatp(int $etatp): self
    {
        $this->etatp = $etatp;

        return $this;
    }
}
