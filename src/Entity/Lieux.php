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
     * @ORM\Column(type="bigint")
     */
    private $num_acc;

    /**
     * @ORM\Column(type="integer")
     */
    private $catr;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $voie;

    /**
     * @ORM\Column(type="integer")
     */
    private $v1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $v2;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $circ;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbv;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vosp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prof;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pr1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $plan;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lartpc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $larrout;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surf;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $infra;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $situ;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vma;



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

    public function getCatr(): ?int
    {
        return $this->catr;
    }

    public function setCatr(int $catr): self
    {
        $this->catr = $catr;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(?string $voie): self
    {
        $this->voie = $voie;

        return $this;
    }

    public function getV1(): ?int
    {
        return $this->v1;
    }

    public function setV1(int $v1): self
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
    public function getCirc(): ?int
    {
        return $this->circ;
    }

    public function setCirc(int $circ): self
    {
        $this->circ = $circ;

        return $this;
    }
    public function getNbv(): ?int
    {
        return $this->nbv;
    }

    public function setNbv(?int $nbv): self
    {
        $this->nbv = $nbv;

        return $this;
    }

    public function getVosp(): ?int
    {
        return $this->vosp;
    }

    public function setVosp(?int $vosp): self
    {
        $this->vosp = $vosp;

        return $this;
    }

    public function getProf(): ?int
    {
        return $this->prof;
    }

    public function setProf(?int $prof): self
    {
        $this->prof = $prof;

        return $this;
    }

    public function getPr(): ?int
    {
        return $this->pr;
    }

    public function setPr(?int $pr): self
    {
        $this->pr = $pr;

        return $this;
    }

    public function getPr1(): ?int
    {
        return $this->pr1;
    }

    public function setPr1(?int $pr1): self
    {
        $this->pr1 = $pr1;

        return $this;
    }

    public function getPlan(): ?int
    {
        return $this->plan;
    }

    public function setPlan(?int $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getLartpc(): ?int
    {
        return $this->lartpc;
    }

    public function setLartpc(?int $lartpc): self
    {
        $this->lartpc = $lartpc;

        return $this;
    }

    public function getLarrout(): ?int
    {
        return $this->larrout;
    }

    public function setLarrout(?int $larrout): self
    {
        $this->larrout = $larrout;

        return $this;
    }

    public function getSurf(): ?int
    {
        return $this->surf;
    }

    public function setSurf(?int $surf): self
    {
        $this->surf = $surf;

        return $this;
    }

    public function getInfra(): ?int
    {
        return $this->infra;
    }

    public function setInfra(?int $infra): self
    {
        $this->infra = $infra;

        return $this;
    }

    public function getSitu(): ?int
    {
        return $this->situ;
    }

    public function setSitu(?int $situ): self
    {
        $this->situ = $situ;

        return $this;
    }

    public function getVma(): ?int
    {
        return $this->vma;
    }

    public function setVma(?int $vma): self
    {
        $this->vma = $vma;

        return $this;
    }
}
