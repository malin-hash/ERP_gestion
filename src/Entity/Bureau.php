<?php

namespace App\Entity;

use App\Repository\BureauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BureauRepository::class)]
class Bureau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\ManyToOne(inversedBy: 'bureaus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ordinateur $ordinateur = null;

    #[ORM\ManyToOne(inversedBy: 'bureaus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Imprimante $imprimante = null;

    #[ORM\ManyToOne(inversedBy: 'bureaus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unitecentral $unitecentral = null;

    /**
     * @var Collection<int, Personnel>
     */
    #[ORM\OneToMany(targetEntity: Personnel::class, mappedBy: 'bureau')]
    private Collection $personnels;

    public function __construct()
    {
        $this->personnels = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getOrdinateur(): ?Ordinateur
    {
        return $this->ordinateur;
    }

    public function setOrdinateur(?Ordinateur $ordinateur): static
    {
        $this->ordinateur = $ordinateur;

        return $this;
    }

    public function getImprimante(): ?Imprimante
    {
        return $this->imprimante;
    }

    public function setImprimante(?Imprimante $imprimante): static
    {
        $this->imprimante = $imprimante;

        return $this;
    }

    public function getUnitecentral(): ?Unitecentral
    {
        return $this->unitecentral;
    }

    public function setUnitecentral(?Unitecentral $unitecentral): static
    {
        $this->unitecentral = $unitecentral;

        return $this;
    }

    /**
     * @return Collection<int, Personnel>
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(Personnel $personnel): static
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels->add($personnel);
            $personnel->setBureau($this);
        }

        return $this;
    }

    public function removePersonnel(Personnel $personnel): static
    {
        if ($this->personnels->removeElement($personnel)) {
            // set the owning side to null (unless already changed)
            if ($personnel->getBureau() === $this) {
                $personnel->setBureau(null);
            }
        }

        return $this;
    }
}
