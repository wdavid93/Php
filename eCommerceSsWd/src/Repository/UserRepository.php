<?php

// Déclaration du namespace pour la classe UserRepository
namespace App\Repository;

// Importation des classes nécessaires
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * Cette classe étend ServiceEntityRepository et implémente PasswordUpgraderInterface
 * pour gérer les utilisateurs et mettre à jour leurs mots de passe.
 *
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    // Constructeur de la classe UserRepository
    public function __construct(ManagerRegistry $registry)
    {
        // Appel du constructeur parent avec le registre de gestion et la classe User
        parent::__construct($registry, User::class);
    }

    /**
     * Méthode utilisée pour mettre à jour (rehacher) le mot de passe de l'utilisateur automatiquement au fil du temps.
     *
     * @param PasswordAuthenticatedUserInterface $user L'utilisateur dont le mot de passe doit être mis à jour
     * @param string $newHashedPassword Le nouveau mot de passe haché
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // Vérification si l'utilisateur est une instance de la classe User
        if (!$user instanceof User) {
            // Si ce n'est pas le cas, lever une exception UnsupportedUserException
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        // Mise à jour du mot de passe de l'utilisateur
        $user->setPassword($newHashedPassword);
        // Persistance de l'utilisateur avec le nouveau mot de passe dans la base de données
        $this->getEntityManager()->persist($user);
        // Validation des changements dans la base de données
        $this->getEntityManager()->flush();
    }

    // Méthodes de recherche commentées pour un usage futur potentiel

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    // public function findByExampleField($value): array
    // {
    //     // Création d'un constructeur de requêtes pour trouver des utilisateurs par un champ d'exemple
    //     return $this->createQueryBuilder('u')
    //         ->andWhere('u.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('u.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // public function findOneBySomeField($value): ?User
    // {
    //     // Création d'un constructeur de requêtes pour trouver un utilisateur par un champ d'exemple
    //     return $this->createQueryBuilder('u')
    //         ->andWhere('u.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
}
