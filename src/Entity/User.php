<?php

namespace App\Entity;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
     #[ORM\ManyToMany(targetEntity:"Quiz", mappedBy:"users")]
     
    private $quizzes;
 
     #[ORM\ManyToMany(targetEntity:"Session", mappedBy:"users")]
     
    private $sessions;
    #[ORM\ManyToMany(targetEntity:Cours::class, inversedBy:"users")]
    #[ORM\JoinTable(name:"user_cours")]
     
    private $cours;
 #[ORM\OneToMany(targetEntity: Reclamation::class, mappedBy:"user")]
                                     
                                     private $reclamations;

    
     #[ORM\ManyToMany(targetEntity:Competition::class, inversedBy:"participants")]
     #[ORM\JoinTable(name:"user_competition")]
     
    private $competitions;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->quizzes = new ArrayCollection();
        $this->reponseReclamations = new ArrayCollection();

    }
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CLIENT = 'client';
    public const ROLE_COACH = 'coach';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: [User::ROLE_ADMIN, User::ROLE_CLIENT, User::ROLE_COACH])]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ReponseReclamation::class)]
    private Collection $reponseReclamations;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    /**
     * @return Collection<int, ReponseReclamation>
     */
    public function getReponseReclamations(): Collection
    {
        return $this->reponseReclamations;
    }

    public function addReponseReclamation(ReponseReclamation $reponseReclamation): static
    {
        if (!$this->reponseReclamations->contains($reponseReclamation)) {
            $this->reponseReclamations->add($reponseReclamation);
            $reponseReclamation->setUser($this);
        }

        return $this;
    }

    public function removeReponseReclamation(ReponseReclamation $reponseReclamation): static
    {
        if ($this->reponseReclamations->removeElement($reponseReclamation)) {
            // set the owning side to null (unless already changed)
            if ($reponseReclamation->getUser() === $this) {
                $reponseReclamation->setUser(null);
            }
        }

        return $this;
    }
  }
