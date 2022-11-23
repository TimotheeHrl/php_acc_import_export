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
    private $senc;

    /**
     * @ORM\Column(type="integer")
     */
    private $catv;

    /**
     * @ORM\Column(type="integer")
     */
    private $obs;

    /**
     * @ORM\Column(type="integer")
     */
    private $obsm;

    /**
     * @ORM\Column(type="integer")
     */
    private $choc;

    /**
     * @ORM\Column(type="integer")
     */
    private $manv;

    /**
     * @ORM\Column(type="integer")
     */
    private $motor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $occutc;



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

    public function getSenc(): ?int
    {
        return $this->senc;
    }

    public function setSenc(int $senc): self
    {
        $this->senc = $senc;

        return $this;
    }

    public function getCatv(): ?int
    {
        return $this->catv;
    }

    public function setCatv(int $catv): self
    {
        $this->catv = $catv;

        return $this;
    }

    public function getObs(): ?int
    {
        return $this->obs;
    }

    public function setObs(int $obs): self
    {
        $this->obs = $obs;

        return $this;
    }

    public function getObsm(): ?int
    {
        return $this->obsm;
    }

    public function setObsm(int $obsm): self
    {
        $this->obsm = $obsm;

        return $this;
    }

    public function getChoc(): ?int
    {
        return $this->choc;
    }

    public function setChoc(int $choc): self
    {
        $this->choc = $choc;

        return $this;
    }

    public function getManv(): ?int
    {
        return $this->manv;
    }

    public function setManv(int $manv): self
    {
        $this->manv = $manv;

        return $this;
    }

    public function getMotor(): ?int
    {
        return $this->motor;
    }

    public function setMotor(int $motor): self
    {
        $this->motor = $motor;

        return $this;
    }

    public function getOccutc(): ?int
    {
        return $this->occutc;
    }

    public function setOccutc(?int $occutc): self
    {
        $this->occutc = $occutc;

        return $this;
    }
}
