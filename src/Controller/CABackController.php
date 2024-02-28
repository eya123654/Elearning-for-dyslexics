<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CABackController extends AbstractController
{
    #[Route('/competB', name: 'app_compet')]
    public function index(): Response
    {
        return $this->render('ca_back/index.html.twig', [
            'controller_name' => 'CABackController',
        ]);
    }
    #[Route('/activiteB', name: 'app_activ')]
    public function index1(): Response
    {
        return $this->render('ca_back/index1.html.twig', [
            'controller_name' => 'CABackController',
        ]);
    }
}
