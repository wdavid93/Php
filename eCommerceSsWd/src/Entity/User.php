<?php

// Déclaration du namespace pour la classe User
namespace App\Entity;

// Importation des classes nécessaires
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// Déclaration de la classe User avec les attributs de Doctrine ORM
#[ORM\Entity(repositoryClass: UserRepository::class)] // Spécifie que cette entité utilise UserRepository
#[ORM\Table(name: '`user`')] // Déclare le nom de la table 'user' en échappant les caractères réservés
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])] // Ajoute une contrainte unique sur la colonne 'email'
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    // Déclaration de l'ID de l'utilisateur
    #[ORM\Id] // Spécifie que c'est la clé primaire
    #[ORM\GeneratedValue] // Indique que la valeur est auto-générée
    #[ORM\Column] // Indique que c'est une colonne de la table
    private ?int $id = null; // Déclaration de la variable $id comme un entier nullable

    // Déclaration de l'email de l'utilisateur
    #[ORM\Column(length: 180)] // Indique que c'est une colonne de la table avec une longueur maximale de 180 caractères
    private ?string $email = null; // Déclaration de la variable $email comme une chaîne nullable

    /**
     * @var list<string> Les rôles de l'utilisateur
     */
    #[ORM\Column] // Indique que c'est une colonne de la table
    private array $roles = []; // Déclaration de la variable $roles comme un tableau

    /**
     * @var string Le mot de passe haché
     */
    #[ORM\Column] // Indique que c'est une colonne de la table
    private ?string $password = null; // Déclaration de la variable $password comme une chaîne nullable

    // Déclaration du nom de l'utilisateur
    #[ORM\Column(length: 255)] // Indique que c'est une colonne de la table avec une longueur maximale de 255 caractères
    private ?string $name = null; // Déclaration de la variable $name comme une chaîne nullable

    // Déclaration du prénom de l'utilisateur
    #[ORM\Column(length: 255)] // Indique que c'est une colonne de la table avec une longueur maximale de 255 caractères
    private ?string $firstname = null; // Déclaration de la variable $firstname comme une chaîne nullable

    // Méthode pour obtenir l'ID de l'utilisateur
    public function getId(): ?int
    {
        return $this->id;
    }

    // Méthode pour obtenir l'email de l'utilisateur
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Méthode pour définir l'email de l'utilisateur
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Identifiant visuel qui représente cet utilisateur.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email; // Utilise l'email comme identifiant de l'utilisateur
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // Garantie que chaque utilisateur a au moins le rôle 'ROLE_USER'
        $roles[] = 'ROLE_USER';

        return array_unique($roles); // Retourne les rôles uniques
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password; // Retourne le mot de passe de l'utilisateur
    }

    // Méthode pour définir le mot de passe de l'utilisateur
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // Si vous stockez des données sensibles temporaires sur l'utilisateur, nettoyez-les ici
        // $this->plainPassword = null; // Exemple de nettoyage de données sensibles
    }

    // Méthode pour obtenir le nom de l'utilisateur
    public function getName(): ?string
    {
        return $this->name;
    }

    // Méthode pour définir le nom de l'utilisateur
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    // Méthode pour obtenir le prénom de l'utilisateur
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    // Méthode pour définir le prénom de l'utilisateur
    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }
}
