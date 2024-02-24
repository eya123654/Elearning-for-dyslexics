<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Formation;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class SessController extends AbstractController
{
    #[Route('/sess', name: 'app_sess')]
    public function index(): Response
    {
        return $this->render('sess/index.html.twig', [
            'controller_name' => 'SessController',
        ]);
    }
    #[Route('/listS', name:'list_session')]
    public function listauthors():Response
{
 $sessions=$this->getDoctrine()->getRepository(Session::class)->findall();

 
    return $this->render('s_fback/index1.html.twig', ['sessions'=>$sessions]);

}
#[Route('/add_s',name:'add_session')]
public function create(EntityManagerInterface $em, ManagerRegistry $doctrine, Request $request): Response
{
    $session = new Session();
    $form = $this->createForm(SessionType::class, $session);
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
        $selectedFormations = $form->get('formations')->getData();
        foreach ($selectedFormations as $formation) {
            $em->persist($formation);
            // Ajoutez la formation à votre entité Session
            $session->addFormation($formation);
        }
        // Get selected formations from the form
        $em = $doctrine->getManager();
        $em->persist($session);
        $em->flush();

        return $this->redirectToRoute('list_session');
    }

    return $this->render('sess/adddata.html.twig', [
        'form' => $form->createView()
    ]);
}
}