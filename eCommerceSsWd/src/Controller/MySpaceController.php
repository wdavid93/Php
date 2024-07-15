<?php

// Déclare le namespace du contrôleur, correspondant à la structure du répertoire
namespace App\Controller;

// Importe les classes nécessaires depuis le framework Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

// Déclare la classe MySpaceController qui étend la classe AbstractController de Symfony
class MySpaceController extends AbstractController
{
    /**
     * La méthode index est associée à la route '/mySpace' grâce à l'attribut #[Route]
     * Cette méthode est appelée lorsque l'utilisateur accède à l'URL '/mySpace'
     *
     * @return JsonResponse La réponse JSON retournée au client
     */
    #[Route('/mySpace', name: 'app_my_space')]
    public function index(): JsonResponse
    {
        // Retourne une réponse JSON contenant un message et le chemin du fichier de contrôleur
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MySpaceController.php',
        ]);
    }
}
