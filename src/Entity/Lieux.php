<?php

namespace App\Entity;

use App\Repository\LieuxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuxRepository::class)
 */
class Lieux
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
    private $catr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voie;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $v1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $v2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $circ;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nbv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vosp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prof;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lartpc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $larrout;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $infra;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $situ;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vma;



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

    public function getCatr(): ?string
    {
        return $this->catr;
    }

    public function setCatr(string $catr): self
    {
        $this->catr = $catr;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(string $voie): self
    {
        $this->voie = $voie;

        return $this;
    }

    public function getV1(): ?string
    {
        return $this->v1;
    }

    public function setV1(string $v1): self
    {
        $this->v1 = $v1;

        return $this;
    }

    public function getV2(): ?string
    {
        return $this->v2;
    }

    public function setV2(string $v2): self
    {
        $this->v2 = $v2;

        return $this;
    }

    public function getCirc(): ?string
    {
        return $this->circ;
    }

    public function setCirc(string $circ): self
    {
        $this->circ = $circ;

        return $this;
    }

    public function getNbv(): ?string
    {
        return $this->nbv;
    }

    public function setNbv(string $nbv): self
    {
        $this->nbv = $nbv;

        return $this;
    }

    public function getVosp(): ?string
    {
        return $this->vosp;
    }

    public function setVosp(string $vosp): self
    {
        $this->vosp = $vosp;

        return $this;
    }

    public function getProf(): ?string
    {
        return $this->prof;
    }

    public function setProf(string $prof): self
    {
        $this->prof = $prof;

        return $this;
    }

    public function getPr(): ?string
    {
        return $this->pr;
    }

    public function setPr(string $pr): self
    {
        $this->pr = $pr;

        return $this;
    }

    public function getPr1(): ?string
    {
        return $this->pr1;
    }

    public function setPr1(string $pr1): self
    {
        $this->pr1 = $pr1;

        return $this;
    }

    public function getPlan(): ?string
    {
        return $this->plan;
    }

    public function setPlan(string $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getLartpc(): ?string
    {
        return $this->lartpc;
    }

    public function setLartpc(string $lartpc): self
    {
        $this->lartpc = $lartpc;

        return $this;
    }

    public function getLarrout(): ?string
    {
        return $this->larrout;
    }

    public function setLarrout(string $larrout): self
    {
        $this->larrout = $larrout;

        return $this;
    }

    public function getSurf(): ?string
    {
        return $this->surf;
    }

    public function setSurf(string $surf): self
    {
        $this->surf = $surf;

        return $this;
    }

    public function getInfra(): ?string
    {
        return $this->infra;
    }

    public function setInfra(string $infra): self
    {
        $this->infra = $infra;

        return $this;
    }

    public function getSitu(): ?string
    {
        return $this->situ;
    }

    public function setSitu(string $situ): self
    {
        $this->situ = $situ;

        return $this;
    }

    public function getVma(): ?string
    {
        return $this->vma;
    }

    public function setVma(string $vma): self
    {
        $this->vma = $vma;

        return $this;
    }
}
