<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
     
     #[ORM\ManyToOne(targetEntity:Quiz::class, inversedBy:"questions")]
     #[ORM\JoinColumn(nullable:false)]
  
    private $quiz;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse_question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getReponseQuestion(): ?string
    {
        return $this->reponse_question;
    }

    public function setReponseQuestion(string $reponse_question): static
    {
        $this->reponse_question = $reponse_question;

        return $this;
    }
}
