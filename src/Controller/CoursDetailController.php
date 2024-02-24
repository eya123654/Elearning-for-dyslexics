<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursDetailController extends AbstractController
{
    #[Route('/cours/detail', name: 'app_cours_detail')]
    public function index(): Response
    {
        return $this->render('cours_detail/detail_course.html.twig');
    }
}
