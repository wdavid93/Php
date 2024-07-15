<?php

// Déclare le namespace du contrôleur, correspondant à la structure du répertoire
namespace App\Controller;

// Importe les classes nécessaires depuis le framework Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// Déclare la classe SecurityController qui étend la classe AbstractController de Symfony
class SecurityController extends AbstractController
{
    // Définit la route '/login' pour la méthode login() avec le nom de route 'app_login'
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Vérifie si l'utilisateur est déjà connecté et redirige vers une autre page
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Récupère le dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Rend la vue 'security/login.html.twig' en passant les variables 'last_username' et 'error'
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    // Définit la route '/logout' pour la méthode logout() avec le nom de route 'app_logout'
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Lance une exception logique pour indiquer que cette méthode peut être laissée vide
        // Elle sera interceptée par la clé de déconnexion sur votre pare-feu
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
