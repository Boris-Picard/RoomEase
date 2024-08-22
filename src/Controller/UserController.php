<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/user/create', name: 'create_user')]
    public function createUser(EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $existingUser = $entityManager->getRepository(User::class)
            ->findOneBy(['email' => 'boris2@gmail.com']);

        if ($existingUser) {
            throw new Exception('L\'utilisateur existe déjà avec cet email');
        }

        $user = new User();
        $user->setName('Boris');
        $user->setEmail('ad@ad.com');
        $user->setPassword('1234adadaddad');
        $user->setStatus(0);
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $entityManager->persist($user);

        $entityManager->flush();

        return new Response('Saved new user with id :' . $user->getId());
    }

    // #[Route('/user/{id<\d+>}', name: 'user_show')]
    // public function show(EntityManagerInterface $entityManager, int $id): Response
    // {
    //     $user = $entityManager->getRepository(User::class)->find($id);

    //     if (!$user) {
    //         throw $this->createNotFoundException('Pas d\'utilisateur pour l\'id ' . $id);
    //     }

    //     return new Response('Utilisater :' . $user->getName());
    // }

    #[Route('/user/{id}', name: 'user_show')]
    public function showByPk(User $user): Response
    {
        return $this->json($user);
    }

    #[Route('user/update/{id}', name: 'user_update')]
    public function update(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Pas de user ! ' . $id);
        }

        $user->setName('Paul');
        $user->setUpdatedAt(new \DateTime());
        $entityManager->flush();

        return $this->redirectToRoute('user_show', [
            'id' => $user->getId(),
        ]);
    }

    #[Route('/user/delete/{id}', name: 'user_delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Pas de user ! ' . $id);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return new Response('User supprimé !');
    }

    #[Route('/user/email/', name: 'get_user_email')]
    public function getUserByMail(EntityManagerInterface $entityManager): Response
    {
        $email = 'ad@ad.com';

        $user = $entityManager->getRepository(User::class)->findUserByEmail($email);
        
        if (!$user) {
            return new Response('User not found', 404);
        }
    
        return new Response('User found: ' . $user->getName());
    }
}
