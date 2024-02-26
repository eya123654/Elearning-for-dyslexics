<?php

namespace App\Controller;

use App\Repository\UserRepository;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lecon;
use App\Form\LeconType;
use App\Repository\LeconRepository;


class CLBackController extends AbstractController
{
    #[Route('/coursb', name: 'app_c_back', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cl_back/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }
    #[Route('/addcourses', name: 'app_cours_news', methods: ['GET', 'POST'])]
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
    
            return $this->redirectToRoute('app_c_back', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('cl_back/add_cours.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

 

    #[Route('show/{id}', name: 'app_cours_shows', methods: ['GET'])]
    public function show(Cours $cour, UserRepository $userRepository): Response
    { 
       # dd( $cour->getUsers());
      #  $users = $userRepository->getUsers($cour); 
        return $this->render('cl_back/show.html.twig', [
            'cour' => $cour,
            'users' => $cour->getUsers(),
        ]);
    }

    #[Route('/{id}/update', name: 'app_cours_edits', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_c_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cl_back/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_deletes', methods: ['POST'])]
    public function delete(Request $request, Cours $cour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_c_back', [], Response::HTTP_SEE_OTHER);
    }




    
}
