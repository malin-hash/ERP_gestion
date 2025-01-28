<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnelRepository::class)]
class Personnel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datenaisse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateentre = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poste $poste = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'personnelles')]
    private ?Materiel $material = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDatenaisse(): ?\DateTimeInterface
    {
        return $this->datenaisse;
    }

    public function setDatenaisse(\DateTimeInterface $datenaisse): static
    {
        $this->datenaisse = $datenaisse;

        return $this;
    }

    public function getDateentre(): ?\DateTimeInterface
    {
        return $this->dateentre;
    }

    public function setDateentre(\DateTimeInterface $dateentre): static
    {
        $this->dateentre = $dateentre;

        return $this;
    }

    public function getPoste(): ?Poste
    {
        return $this->poste;
    }

    public function setPoste(?Poste $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getMaterial(): ?Materiel
    {
        return $this->material;
    }

    public function setMaterial(?Materiel $material): static
    {
        $this->material = $material;

        return $this;
    }
}
