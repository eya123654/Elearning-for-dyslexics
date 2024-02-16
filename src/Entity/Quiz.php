<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
     
     #[ORM\ManyToMany(targetEntity:"User", inversedBy:"quizzes")]
     #[ORM\JoinTable(name:"user_quiz")]
     
    private $users;
     #[ORM\ManyToOne(targetEntity:Lecon::class, inversedBy:"quiz")]
     #[ORM\JoinColumn(nullable:false)]
     
    private $lecon;

   
     #[ORM\OneToMany(targetEntity:Question::class, mappedBy:"quiz")]
     
    private $questions;
    public function __construct() {
        $this->users = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $nbr_question = null;

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

    public function getNbrQuestion(): ?int
    {
        return $this->nbr_question;
    }

    public function setNbrQuestion(int $nbr_question): static
    {
        $this->nbr_question = $nbr_question;

        return $this;
    }
}
