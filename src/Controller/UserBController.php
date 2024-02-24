<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserBController extends AbstractController
{
    #[Route('/user/b', name: 'app_user_b')]
    public function index(): Response
    {
        return $this->render('user_b/index.html.twig', [
            'controller_name' => 'UserBController',
        ]);
    }
    #[Route('/coach/b', name: 'app_coach_b')]
    public function index1(): Response
    {
        return $this->render('user_b/index.html.twig', [
            'controller_name' => 'UserBController',
        ]);
    }
}
