<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Error\Error;
use Doctrine\ORM\EntityManagerInterface;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(FormationRepository $rep): Response
    {

      $formations=$rep->findAll();
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
    #[Route('/listformation', name:'listformation')]
    public function listauthors():Response
{
 $formations=$this->getDoctrine()->getRepository(Formation::class)->findall();

 
    return $this->render('s_fback/index.html.twig', ['formations'=>$formations]);

}
#[Route('/create', name :'app_create')]
public function create(ManagerRegistry $doctrine ,Request $req):Response
{
    $s = new Formation(); 

    $form = $this->createForm(FormationType::class, $s);
    //dd($form->getErrors(true, false));

    $form->handleRequest($req);
    $errors = $form->getErrors();

foreach ($errors as $error) {
    echo $error->getMessage()."<br>";
}
    //dd($s);
    if ($form->isSubmitted() && $form->isValid()) {
        //dd($s);
        
        $em = $doctrine->getManager();
        $em->persist($s);
        $em->flush();
        return $this->redirectToRoute('listformation');
    }

    return $this->render('formation/adddata.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route('/update/{id}' , name:"app_update")]
public function update(Request $request , $id): Response
{ $entity=$this->getDoctrine()->getManager();
    $author =$entity->getRepository(Formation::class)->find($id);
    $form=$this->createForm(FormationType::class , $author);
    $form->handleRequest($request);
    
    if($form->isSubmitted())
    {
    $entity->flush();
    return $this->redirectToRoute('listformation');
}
    return $this->render('formation/adddata.html.twig', ['form'=>$form->createView()]);
    
}

#[Route('/delete/{id}' , name:'app_delete')]
public function deleteform(ManagerRegistry $m  , EntityManagerInterface $em , $id, FormationRepository $repo):Response
{
    $formations = $em->getRepository(Formation::class)->find($id);
    if ($formations !== null) {
        $em->remove($formations);
        $em->flush();
    } else {
        $errorMessage = '.';
    }
    return $this->redirectToRoute('listformation');
}


}