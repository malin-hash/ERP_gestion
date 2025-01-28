<?php

namespace App\Entity;

use App\Repository\PrimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrimeRepository::class)]
class Prime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\Column]
    private ?int $montant = null;

    /**
     * @var Collection<int, Poste>
     */
    #[ORM\ManyToMany(targetEntity: Poste::class)]
    private Collection $poste;

    public function __construct()
    {
        $this->poste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): static
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection<int, Poste>
     */
    public function getPoste(): Collection
    {
        return $this->poste;
    }

    public function addPoste(Poste $poste): static
    {
        if (!$this->poste->contains($poste)) {
            $this->poste->add($poste);
        }

        return $this;
    }

    public function removePoste(Poste $poste): static
    {
        $this->poste->removeElement($poste);

        return $this;
    }
}
