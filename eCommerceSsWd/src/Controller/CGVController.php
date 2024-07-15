<?php

// Déclare le namespace du contrôleur, correspondant à la structure du répertoire
namespace App\Controller;

// Importe les classes nécessaires depuis le framework Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

// Déclare la classe CGVController qui étend la classe AbstractController de Symfony
class CGVController extends AbstractController
{
    /**
     * La méthode index est associée à la route '/c/g/v' grâce à l'attribut #[Route]
     * Cette méthode est appelée lorsque l'utilisateur accède à l'URL '/c/g/v'
     *
     * @return JsonResponse La réponse JSON retournée au client
     */
    #[Route('/c/g/v', name: 'app_c_g_v')]
    public function index(): JsonResponse
    {
        // Retourne une réponse JSON contenant un message et le chemin du fichier de contrôleur
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CGVController.php',
        ]);
    }
}
