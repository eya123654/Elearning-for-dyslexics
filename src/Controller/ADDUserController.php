<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ADDUserController extends AbstractController
{
   #[Route('/add', name: 'app_add_user')]
    public function index(): Response
    { 
        return $this->render('back/index.html.twig', [
            'controller_name' => 'ADDUserController',
        ]);
    }
}
