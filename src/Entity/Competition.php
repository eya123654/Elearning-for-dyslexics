<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
     
     #[ORM\ManyToMany(targetEntity:User::class, mappedBy:"competitions")]
     
    private $participants;

    
     #[ORM\OneToMany(targetEntity:Activite::class, mappedBy:"competition")]
     
    private $activites;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->activites = new ArrayCollection();
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255)]
    private ?string $heure = null;

    #[ORM\Column(length: 255)]
    private ?int $nbr_participant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): static
    {
        $this->heure = $heure;

        return $this;
    }

    public function getNbrParticipant(): ?int
    {
        return $this->nbr_participant;
    }

    public function setNbrParticipant(int $nbr_participant): static
    {
        $this->nbr_participant = $nbr_participant;

        return $this;
    }
}
