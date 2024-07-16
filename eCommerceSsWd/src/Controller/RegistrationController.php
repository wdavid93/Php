<?php

// Déclare le namespace du contrôleur, correspondant à la structure du répertoire
namespace App\Controller;

// Importe les classes nécessaires depuis le framework Symfony et d'autres classes liées
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

// Déclare la classe RegistrationController qui étend la classe AbstractController de Symfony
class RegistrationController extends AbstractController
{
    // Constructeur de la classe avec une injection de dépendance pour EmailVerifier
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    // Méthode pour gérer l'inscription des utilisateurs, associée à la route '/register'
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // Crée une nouvelle instance de l'entité User
        $user = new User();

        // Crée le formulaire d'inscription en utilisant RegistrationFormType et associe les données de la requête
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // Vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Encode le mot de passe brut de l'utilisateur en utilisant UserPasswordHasherInterface
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Persiste l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Génère une URL signée et envoie un email de confirmation à l'utilisateur
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('william.david93000@gmail.com', 'DW Prod'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // Redirige l'utilisateur vers la page de connexion après l'inscription réussie
            return $this->redirectToRoute('app_login');
        }

        // Rend le template 'register.html.twig' avec le formulaire d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    // Méthode pour gérer la vérification de l'email des utilisateurs, associée à la route '/verify/email'
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        // Vérifie que l'utilisateur est pleinement authentifié, sinon refuse l'accès
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Valide le lien de confirmation de l'email, défini User::isVerified=true et persiste
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            // En cas d'erreur, ajoute un message flash d'erreur et redirige vers 'app_register'
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_login');
        }

        // En cas de succès, ajoute un message flash de succès et redirige vers 'app_register'
        $this->addFlash('success', 'Votre adresse e-mail est bien vérifiée / Your email address has been verified.');

        return $this->redirectToRoute('app_login');
    }
}
