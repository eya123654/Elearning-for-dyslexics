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
use App\Entity\Lecon;
use App\Form\LeconType;
use App\Repository\LeconRepository;
class CoursLeconsController extends AbstractController
{


    #[Route('/Lessonb', name: 'app_L_back', methods: ['GET'])]
    public function index1(LeconRepository $leconRepository): Response
    {
        return $this->render('cl_back/indexL.html.twig', [
            'lecons' => $leconRepository->findAll(),
        ]);
    }
    #[Route('/newless', name: 'app_lesson_news', methods: ['GET', 'POST'])]
    public function newLesson(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lecon = new Lecon();
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);
    
       
        $quiz = $lecon->getQuiz();  // Si la leçon n'a pas encore de quiz associé, $quiz sera null
         
        if ($form->isSubmitted() && $form->isValid()) {
            // Si vous avez besoin de manipuler les données soumises avant la sauvegarde
            // $lecon = $form->getData();
    
            $entityManager->persist($lecon);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_L_back', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('cl_back/add_lesson.html.twig', [
            'lecon' => $lecon,
            'form' => $form,

        ]);
    }
    
    #[Route('/{id}/show', name: 'app_lecon_shows', methods: ['GET'])]
    public function showLesson(Lecon $lecon): Response
    {
        return $this->render('cl_back/showL.html.twig', [
            'lecon' => $lecon,
        ]);
    }
    
    #[Route('/{id}/edit/lesson', name: 'app_lesson_edit', methods: ['GET', 'POST'])]
    public function editlesson(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_L_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cl_back/editL.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_lesson_delete', methods: ['POST'])]
    public function deletelesson(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lecon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lecon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_L_back', [], Response::HTTP_SEE_OTHER);
    }
   }
   
