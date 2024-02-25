<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizBController extends AbstractController
{
    #[Route('/quiz/b', name: 'quiz_b')]
    public function index(): Response
    {
        return $this->render('quiz_b/index.html.twig', [
            'controller_name' => 'QuizBController',
        ]);
    }
    #[Route('/Question/b', name: 'quest_b')]
    public function index1(): Response
    {
        return $this->render('quiz_b/index.html.twig', [
            'controller_name' => 'QuizBController',
        ]);
    }
}
