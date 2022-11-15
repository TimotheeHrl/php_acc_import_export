<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
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
    private $senc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $obs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $obsm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $manv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $occutc;

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

    public function getSenc(): ?string
    {
        return $this->senc;
    }

    public function setSenc(string $senc): self
    {
        $this->senc = $senc;

        return $this;
    }

    public function getCatv(): ?string
    {
        return $this->catv;
    }

    public function setCatv(string $catv): self
    {
        $this->catv = $catv;

        return $this;
    }

    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(string $obs): self
    {
        $this->obs = $obs;

        return $this;
    }

    public function getObsm(): ?string
    {
        return $this->obsm;
    }

    public function setObsm(string $obsm): self
    {
        $this->obsm = $obsm;

        return $this;
    }

    public function getChoc(): ?string
    {
        return $this->choc;
    }

    public function setChoc(string $choc): self
    {
        $this->choc = $choc;

        return $this;
    }

    public function getManv(): ?string
    {
        return $this->manv;
    }

    public function setManv(string $manv): self
    {
        $this->manv = $manv;

        return $this;
    }

    public function getMotor(): ?string
    {
        return $this->motor;
    }

    public function setMotor(string $motor): self
    {
        $this->motor = $motor;

        return $this;
    }

    public function getOccutc(): ?string
    {
        return $this->occutc;
    }

    public function setOccutc(string $occutc): self
    {
        $this->occutc = $occutc;

        return $this;
    }
}
