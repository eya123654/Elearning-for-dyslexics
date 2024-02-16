<?php

namespace App\Entity;
use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    
    #[ORM\ManyToMany(targetEntity:"User", inversedBy:"sessions")]
    #[ORM\JoinTable(name:"user_session")]
     
    private $users;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $date_d = null;

    #[ORM\Column(length: 255)]
    private ?string $date_f = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    
      #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: "sessions")]
      #[ORM\JoinTable(name: "session_formation")]
     
    private $formations;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateD(): ?string
    {
        return $this->date_d;
    }

    public function setDateD(string $date_d): self
    {
        $this->date_d = $date_d;

        return $this;
    }

    public function getDateF(): ?string
    {
        return $this->date_f;
    }

    public function setDateF(string $date_f): self
    {
        $this->date_f = $date_f;

        return $this;
    }

    public function getNomSession(): ?string
    {
        return $this->nom;
    }

    public function setNomSession(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
