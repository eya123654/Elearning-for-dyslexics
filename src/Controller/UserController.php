<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        $user = new User();
        $user->setNom('john_doe');
        $user->setPrenom('john_doe');
        $user->setEmail('john@example.com');
        $user->setAge(20);
        $user->setMotDePasse('password123');
        $role = "testeur"; // Le rôle que vous souhaitez ajouter
    if (!in_array($role, [User::ROLE_ADMIN, User::ROLE_CLIENT, User::ROLE_COACH])) {
        // Si le rôle n'est pas valide, vous pouvez renvoyer une erreur ou gérer la situation en conséquence
        // Dans cet exemple, je vais simplement renvoyer une réponse avec un message d'erreur
        return new Response('Le rôle spécifié n\'est pas valide.', Response::HTTP_BAD_REQUEST);
    }

    $user->setRole($role);
        $date = new DateTime('now'); // Assumer que vous avez une constante ROLE_USER dans votre entité User
        $user->setDateInscription($date);
        // Enregistrer l'utilisateur en base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_user');

      
    }
}
