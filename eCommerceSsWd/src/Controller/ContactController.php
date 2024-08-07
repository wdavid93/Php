<?php

// Déclare le namespace du contrôleur, correspondant à la structure du répertoire
namespace App\Controller;

// Importe les classes nécessaires depuis le framework Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

// Déclare la classe ContactController qui étend la classe AbstractController de Symfony
class ContactController extends AbstractController
{
    /**
     * La méthode index est associée à la route '/contact' grâce à l'attribut #[Route]
     * Cette méthode est appelée lorsque l'utilisateur accède à l'URL '/contact'
     *
     * @return JsonResponse La réponse JSON retournée au client
     */
    #[Route('/contact', name: 'app_contact')]
    public function index(): JsonResponse
    {
        // Retourne une réponse JSON contenant un message et le chemin du fichier de contrôleur
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ContactController.php',
        ]);
    }
}
