<?php

namespace App\Entity;

use App\Repository\ImprimanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImprimanteRepository::class)]
class Imprimante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'imprimantes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipement $type = null;

    /**
     * @var Collection<int, Bureau>
     */
    #[ORM\OneToMany(targetEntity: Bureau::class, mappedBy: 'imprimante')]
    private Collection $bureaus;

    #[ORM\ManyToOne(inversedBy: 'imprimantes')]
    private ?Marque $marque = null;

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
            $bureau->setImprimante($this);
        }

        return $this;
    }

    public function removeBureau(Bureau $bureau): static
    {
        if ($this->bureaus->removeElement($bureau)) {
            // set the owning side to null (unless already changed)
            if ($bureau->getImprimante() === $this) {
                $bureau->setImprimante(null);
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
}
