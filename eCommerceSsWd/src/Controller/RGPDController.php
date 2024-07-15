<?php

// Déclare le namespace du contrôleur, correspondant à la structure du répertoire
namespace App\Controller;

// Importe les classes nécessaires depuis le framework Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

// Déclare la classe RGPDController qui étend la classe AbstractController de Symfony
class RGPDController extends AbstractController
{
    // Définit la route '/r/g/p/d' pour la méthode index() avec le nom de route 'app_r_g_p_d'
    #[Route('/r/g/p/d', name: 'app_r_g_p_d')]
    public function index(): JsonResponse
    {
        // Retourne une réponse JSON avec un message et le chemin du contrôleur
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RGPDController.php',
        ]);
    }
}
