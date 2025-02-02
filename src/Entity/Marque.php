<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Ordinateur>
     */
    #[ORM\OneToMany(targetEntity: Ordinateur::class, mappedBy: 'marque')]
    private Collection $ordinateurs;

    /**
     * @var Collection<int, Imprimante>
     */
    #[ORM\OneToMany(targetEntity: Imprimante::class, mappedBy: 'marque')]
    private Collection $imprimantes;

    /**
     * @var Collection<int, Unitecentral>
     */
    #[ORM\OneToMany(targetEntity: Unitecentral::class, mappedBy: 'marque')]
    private Collection $unitecentrals;

    public function __construct()
    {
        $this->ordinateurs = new ArrayCollection();
        $this->imprimantes = new ArrayCollection();
        $this->unitecentrals = new ArrayCollection();
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

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getOrdinateurs(): Collection
    {
        return $this->ordinateurs;
    }

    public function addOrdinateur(Ordinateur $ordinateur): static
    {
        if (!$this->ordinateurs->contains($ordinateur)) {
            $this->ordinateurs->add($ordinateur);
            $ordinateur->setMarque($this);
        }

        return $this;
    }

    public function removeOrdinateur(Ordinateur $ordinateur): static
    {
        if ($this->ordinateurs->removeElement($ordinateur)) {
            // set the owning side to null (unless already changed)
            if ($ordinateur->getMarque() === $this) {
                $ordinateur->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Imprimante>
     */
    public function getImprimantes(): Collection
    {
        return $this->imprimantes;
    }

    public function addImprimante(Imprimante $imprimante): static
    {
        if (!$this->imprimantes->contains($imprimante)) {
            $this->imprimantes->add($imprimante);
            $imprimante->setMarque($this);
        }

        return $this;
    }

    public function removeImprimante(Imprimante $imprimante): static
    {
        if ($this->imprimantes->removeElement($imprimante)) {
            // set the owning side to null (unless already changed)
            if ($imprimante->getMarque() === $this) {
                $imprimante->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Unitecentral>
     */
    public function getUnitecentrals(): Collection
    {
        return $this->unitecentrals;
    }

    public function addUnitecentral(Unitecentral $unitecentral): static
    {
        if (!$this->unitecentrals->contains($unitecentral)) {
            $this->unitecentrals->add($unitecentral);
            $unitecentral->setMarque($this);
        }

        return $this;
    }

    public function removeUnitecentral(Unitecentral $unitecentral): static
    {
        if ($this->unitecentrals->removeElement($unitecentral)) {
            // set the owning side to null (unless already changed)
            if ($unitecentral->getMarque() === $this) {
                $unitecentral->setMarque(null);
            }
        }

        return $this;
    }
}
