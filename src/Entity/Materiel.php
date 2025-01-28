<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Proxies\__CG__\App\Entity\Typemateriel;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datebuy = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?int $rame = null;

    #[ORM\Column]
    private ?int $disque = null;

    #[ORM\Column(length: 255)]
    private ?string $core = null;

    #[ORM\Column(length: 255)]
    private ?string $systeme = null;

    #[ORM\Column(length: 255)]
    private ?string $generation = null;

    /**
     * @var Collection<int, Personnel>
     */
    #[ORM\OneToMany(targetEntity: Personnel::class, mappedBy: 'materiel')]
    private Collection $personnels;

    /**
     * @var Collection<int, Personnel>
     */
    #[ORM\OneToMany(targetEntity: Personnel::class, mappedBy: 'material')]
    private Collection $personnelles;

    public function __construct()
    {
        $this->personnels = new ArrayCollection();
        $this->personnelles = new ArrayCollection();
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

    public function getDatebuy(): ?\DateTimeInterface
    {
        return $this->datebuy;
    }

    public function setDatebuy(\DateTimeInterface $datebuy): static
    {
        $this->datebuy = $datebuy;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getRame(): ?int
    {
        return $this->rame;
    }

    public function setRame(int $rame): static
    {
        $this->rame = $rame;

        return $this;
    }

    public function getDisque(): ?int
    {
        return $this->disque;
    }

    public function setDisque(int $disque): static
    {
        $this->disque = $disque;

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

    public function getSysteme(): ?string
    {
        return $this->systeme;
    }

    public function setSysteme(string $systeme): static
    {
        $this->systeme = $systeme;

        return $this;
    }

    public function getGeneration(): ?string
    {
        return $this->generation;
    }

    public function setGeneration(string $generation): static
    {
        $this->generation = $generation;

        return $this;
    }

    /**
     * @return Collection<int, Personnel>
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    /**
     * @return Collection<int, Personnel>
     */
    public function getPersonnelles(): Collection
    {
        return $this->personnelles;
    }

    public function addPersonnelle(Personnel $personnelle): static
    {
        if (!$this->personnelles->contains($personnelle)) {
            $this->personnelles->add($personnelle);
            $personnelle->setMaterial($this);
        }

        return $this;
    }

    public function removePersonnelle(Personnel $personnelle): static
    {
        if ($this->personnelles->removeElement($personnelle)) {
            // set the owning side to null (unless already changed)
            if ($personnelle->getMaterial() === $this) {
                $personnelle->setMaterial(null);
            }
        }

        return $this;
    }
}
