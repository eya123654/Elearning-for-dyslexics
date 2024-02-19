<?php

namespace App\Entity;
use Doctrine\Common\Collections\Collection;

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
    public function getLecon(): ?Lecon
    {
        return $this->lecon;
    }

    public function setLecon(?Lecon $lecon): self
    {
        $this->lecon = $lecon;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }
}
