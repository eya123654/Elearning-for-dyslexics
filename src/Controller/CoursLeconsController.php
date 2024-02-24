<?php

namespace App\Controller;
use App\Repository\UserRepository;

use App\Entity\Cours;
use App\Form\CoursType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class CoursLeconsController extends AbstractController
{
   #[Route('/addCL', name: 'app_add_CL', methods: ['GET', 'POST'])]
   public function new(Request $request, EntityManagerInterface $entityManager): Response
   {
       $cour = new Cours();
       $form = $this->createForm(CoursType::class, $cour);
       $form->handleRequest($request);
   
       if ($form->isSubmitted() && $form->isValid()) {
           // Handle users association
           $selectedUsers = $form->get('users')->getData();
           foreach ($selectedUsers as $user) {
               $cour->addUser($user); 
           }
   
           $entityManager->persist($cour);
           $entityManager->flush();
   
           return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
       }
   
       return $this->renderForm('cours/new.html.twig', [
           'cour' => $cour,
           'form' => $form,
       ]);
   }
   
}