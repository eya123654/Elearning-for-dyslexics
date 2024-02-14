<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class CoursLeconsController extends AbstractController
{
   #[Route('/addCL', name: 'app_add_CL')]
    public function index(): Response
    { 
        return $this->render('back/index.html.twig', [
            'controller_name' => 'CoursLeconsController',
        ]);
    }
}