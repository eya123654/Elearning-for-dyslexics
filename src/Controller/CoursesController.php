<?php

namespace App\Controller;
use App\Repository\CoursRepository;
use App\Entity\Cours;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursesController extends AbstractController
{
    #[Route('/courses', name: 'app_courses')]
    public function index(Request $request, CoursRepository $coursRepository): Response
    {// Get the page number from the request, default to 1
        $page = $request->query->getInt('page', 1);
        // Number of items per page
        $limit = 3; // Adjust this according to your needs
        
        // Paginate the results
        $pagination = $coursRepository->paginate($page, $limit);
        // Get the total number of pages
        $totalPages = ceil(count($pagination) / $limit);

        return $this->render('courses/index.html.twig', [
            'pagination' => $pagination,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'cours' => $coursRepository->findAll(),
        ]);
        
      
        
     
    }
}
