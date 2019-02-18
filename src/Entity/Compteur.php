<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompteurRepository")
 * @UniqueEntity(fields={"numero"},message="ce nemero deja utilise")
 */
class Compteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Abonnement", mappedBy="compteur", cascade={"persist", "remove"})
     */
    private $abonnement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        // set (or unset) the owning side of the relation if necessary
        $newCompteur = $abonnement === null ? null : $this;
        if ($newCompteur !== $abonnement->getCompteur()) {
            $abonnement->setCompteur($newCompteur);
        }

        return $this;
    }
}
