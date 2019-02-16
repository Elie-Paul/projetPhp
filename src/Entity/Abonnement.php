<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AbonnementRepository")
 */
class Abonnement
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
    private $contrat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cumulAnc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cumulNouv;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Compteur", inversedBy="abonnement", cascade={"persist", "remove"})
     */
    private $compteur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Facture", mappedBy="abonnement")
     */
    private $factures;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(string $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCumulAnc(): ?float
    {
        return $this->cumulAnc;
    }

    public function setCumulAnc(?float $cumulAnc): self
    {
        $this->cumulAnc = $cumulAnc;

        return $this;
    }

    public function getCumulNouv(): ?float
    {
        return $this->cumulNouv;
    }

    public function setCumulNouv(?float $cumulNouv): self
    {
        $this->cumulNouv = $cumulNouv;

        return $this;
    }

    public function getCompteur(): ?Compteur
    {
        return $this->compteur;
    }

    public function setCompteur(?Compteur $compteur): self
    {
        $this->compteur = $compteur;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setAbonnement($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->contains($facture)) {
            $this->factures->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getAbonnement() === $this) {
                $facture->setAbonnement(null);
            }
        }

        return $this;
    }
}
