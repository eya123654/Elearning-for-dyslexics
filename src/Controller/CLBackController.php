<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CLBackController extends AbstractController
{
    #[Route('/coursb', name: 'app_c_back')]
    public function index(): Response
    {
        return $this->render('cl_back/index.html.twig', [
            'controller_name' => 'CLBackController',
        ]);
    }
    #[Route('/Lessonb', name: 'app_L_back')]
    public function index1(): Response
    {
        return $this->render('cl_back/index.html.twig', [
            'controller_name' => 'CLBackController',
        ]);
    }
}
