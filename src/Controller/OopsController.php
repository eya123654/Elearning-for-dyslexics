<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OopsController extends AbstractController
{
    #[Route('/oops', name: 'app_oops')]
    public function index(): Response
    {
        return $this->render('oops/index.html.twig', [
            'controller_name' => 'OopsController',
        ]);
    }
}
