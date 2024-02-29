<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cours;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Lecon;
use App\Repository\LeconRepository;
class CoursDetailController extends AbstractController
{
    #[Route('/cours/detail/{id}', name: 'app_cours_details')]
    public function index(Request $request,$id): Response
    {
        $course = $this->getDoctrine()->getRepository(Cours::class)->find($id);

     
        if (!$course) {
            throw $this->createNotFoundException('The course does not exist');
        }
        $lessons =$this->getDoctrine()->getRepository(Lecon::class)->findBy(['cours' => $id]);

        return $this->render('cours_detail/detail_course.html.twig', [
            'course' => $course,
            'lessons' => $lessons,
        ]);
    }
}
