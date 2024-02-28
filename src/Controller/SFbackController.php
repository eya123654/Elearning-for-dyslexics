<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SFbackController extends AbstractController
{
    #[Route('/fback', name: 'app_s')]
    public function index(): Response
    {
        return $this->render('s_fback/index.html.twig', [
            'controller_name' => 'SFbackController',
        ]);
    }
}
