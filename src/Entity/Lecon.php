<?php

namespace App\Entity;

use App\Repository\LeconRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LeconRepository::class)]
class Lecon
{
       
    #[ORM\OneToOne(targetEntity:Quiz::class, mappedBy:"lecon")]
     
    private $quiz;

    #[ORM\ManyToOne(targetEntity:Cours::class, inversedBy:"lecons")]
    #[ORM\JoinColumn(nullable:false)]
     
    private $cours;

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

     
    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"Le titre de la leçon ne peut pas être vide.")]
    #[Assert\Length(max:255, maxMessage:"Le titre de la leçon ne peut pas dépasser {{ limit }} caractères.")]
   
    private ?string $titre = null;

   
    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"La description de la leçon ne peut pas être vide.")]
    #[Assert\Length(max:255, maxMessage:"La description de la leçon ne peut pas dépasser {{ limit }} caractères.")]
   
    private ?string $description = null;

   
    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message:"Le contenu de la leçon ne peut pas être vide.")]
    #[Assert\Length(max:255, maxMessage:"Le contenu de la leçon ne peut pas dépasser {{ limit }} caractères.")]
   
    private ?string $contenu = null;

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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }
    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
   
}
