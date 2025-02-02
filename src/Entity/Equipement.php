<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $materiel = null;

    /**
     * @var Collection<int, Imprimante>
     */
    #[ORM\OneToMany(targetEntity: Imprimante::class, mappedBy: 'type')]
    private Collection $imprimantes;

    /**
     * @var Collection<int, Ordinateur>
     */
    #[ORM\OneToMany(targetEntity: Ordinateur::class, mappedBy: 'type')]
    private Collection $ordinateurs;

    /**
     * @var Collection<int, Unitecentral>
     */
    #[ORM\OneToMany(targetEntity: Unitecentral::class, mappedBy: 'type')]
    private Collection $unitecentrals;

    public function __construct()
    {
        $this->imprimantes = new ArrayCollection();
        $this->ordinateurs = new ArrayCollection();
        $this->unitecentrals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMateriel(): ?string
    {
        return $this->materiel;
    }

    public function setMateriel(string $materiel): static
    {
        $this->materiel = $materiel;

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
            $imprimante->setType($this);
        }

        return $this;
    }

    public function removeImprimante(Imprimante $imprimante): static
    {
        if ($this->imprimantes->removeElement($imprimante)) {
            // set the owning side to null (unless already changed)
            if ($imprimante->getType() === $this) {
                $imprimante->setType(null);
            }
        }

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
            $ordinateur->setType($this);
        }

        return $this;
    }

    public function removeOrdinateur(Ordinateur $ordinateur): static
    {
        if ($this->ordinateurs->removeElement($ordinateur)) {
            // set the owning side to null (unless already changed)
            if ($ordinateur->getType() === $this) {
                $ordinateur->setType(null);
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
            $unitecentral->setType($this);
        }

        return $this;
    }

    public function removeUnitecentral(Unitecentral $unitecentral): static
    {
        if ($this->unitecentrals->removeElement($unitecentral)) {
            // set the owning side to null (unless already changed)
            if ($unitecentral->getType() === $this) {
                $unitecentral->setType(null);
            }
        }

        return $this;
    }
}
