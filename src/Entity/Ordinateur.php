<?php

namespace App\Entity;

use App\Repository\OrdinateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdinateurRepository::class)]
class Ordinateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipement $type = null;

    #[ORM\Column(length: 255)]
    private ?string $core = null;

    /**
     * @var Collection<int, Bureau>
     */
    #[ORM\OneToMany(targetEntity: Bureau::class, mappedBy: 'ordinateur')]
    private Collection $bureaus;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?System $systeme = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?Generation $generation = null;

    public function __construct()
    {
        $this->bureaus = new ArrayCollection();
    }

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

    public function getType(): ?Equipement
    {
        return $this->type;
    }

    public function setType(?Equipement $type): static
    {
        $this->type = $type;

        return $this;
    }



    public function getCore(): ?string
    {
        return $this->core;
    }

    public function setCore(string $core): static
    {
        $this->core = $core;

        return $this;
    }

    /**
     * @return Collection<int, Bureau>
     */
    public function getBureaus(): Collection
    {
        return $this->bureaus;
    }

    public function addBureau(Bureau $bureau): static
    {
        if (!$this->bureaus->contains($bureau)) {
            $this->bureaus->add($bureau);
            $bureau->setOrdinateur($this);
        }

        return $this;
    }

    public function removeBureau(Bureau $bureau): static
    {
        if ($this->bureaus->removeElement($bureau)) {
            // set the owning side to null (unless already changed)
            if ($bureau->getOrdinateur() === $this) {
                $bureau->setOrdinateur(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getSysteme(): ?System
    {
        return $this->systeme;
    }

    public function setSysteme(?System $systeme): static
    {
        $this->systeme = $systeme;

        return $this;
    }

    public function getGeneration(): ?Generation
    {
        return $this->generation;
    }

    public function setGeneration(?Generation $generation): static
    {
        $this->generation = $generation;

        return $this;
    }
}
