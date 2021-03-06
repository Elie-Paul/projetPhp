<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 * @UniqueEntity(fields={"abonnement"},message="Cet abonnement a deja une facture")
 */
class Facture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $mois;

    /**
     * @ORM\Column(type="float")
     */
    private $consomation;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reglement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Abonnement", inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $abonnement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getConsomation(): ?float
    {
        return $this->consomation;
    }

    public function setConsomation(float $consomation): self
    {
        $this->consomation = $consomation;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getReglement(): ?bool
    {
        return $this->reglement;
    }

    public function setReglement(bool $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }
}
