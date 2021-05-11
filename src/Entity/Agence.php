<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel_agence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_ville;

    /**
     * @ORM\OneToOne(targetEntity=Voiture::class, mappedBy="idagence", cascade={"persist", "remove"})
     */
    private $voiture;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelAgence(): ?int
    {
        return $this->tel_agence;
    }

    public function setTelAgence(int $tel_agence): self
    {
        $this->tel_agence = $tel_agence;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this->adresse_ville;
    }

    public function setAdresseVille(string $adresse_ville): self
    {
        $this->adresse_ville = $adresse_ville;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        // unset the owning side of the relation if necessary
        if ($voiture === null && $this->voiture !== null) {
            $this->voiture->setIdagence(null);
        }

        // set the owning side of the relation if necessary
        if ($voiture !== null && $voiture->getIdagence() !== $this) {
            $voiture->setIdagence($this);
        }

        $this->voiture = $voiture;

        return $this;
    }
    public function __toString() {
        return $this->getNom();
      }

}
