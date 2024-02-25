<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    
    #[ORM\ManyToMany(targetEntity: Session::class, mappedBy: "formations")]
    private $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    /**
     * @return Collection|Session[]
     */

    public function getSessions(): Collection
    {
        return $this->sessions;
    
    }

    public const niveau_0 = 'beginner';
    public const niveau_1 = 'intermediaire';
    public const niveau_2 = 'advanced';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"you must choose the name")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: "The description name should not contain any digits."
    )]
    #[Assert\NotBlank( message: "You must enter description")]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank( message: "You must enter thematique")]
    private ?string $thematique = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"you must choose the number of participants")]
    private ?int $nbr_participant = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: [Formation::niveau_0, Formation::niveau_1, Formation::niveau_2])]
    #[Assert\NotBlank(message:"you must choose the level")]
    private ?string $niveau = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getThematique(): ?string
    {
        return $this->thematique;
    }

    public function setThematique(string $thematique): static
    {
        $this->thematique = $thematique;

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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }
    
    
}
