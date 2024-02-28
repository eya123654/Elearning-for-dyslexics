<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    
      #[ORM\ManyToMany(targetEntity:User::class, mappedBy:"cours")]
     
    private $users;

   
     #[ORM\OneToMany(targetEntity:Lecon::class, mappedBy:"cours")]
     
    private $lecons;

    public function __construct()
    {
        $this->lecons = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection|Lecon[]
     */
    public function getLecons(): Collection
    {
        return $this->lecons;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_cours = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $avancement = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCours(): ?string
    {
        return $this->nom_cours;
    }

    public function setNomCours(string $nom_cours): static
    {
        $this->nom_cours = $nom_cours;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAvancement(): ?int
    {
        return $this->avancement;
    }

    public function setAvancement(int $avancement): static
    {
        $this->avancement = $avancement;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
}
