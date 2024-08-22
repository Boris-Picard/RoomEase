<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'create_user')]
    public function createUser(EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $existingUser = $entityManager->getRepository(User::class)
            ->findOneBy(['email' => 'boris2@gmail.com']);

        if ($existingUser) {
            throw new Exception('L\'utilisateur existe déjà avec cet email');
        }

        $user = new User();
        $user->setName('Boris');
        $user->setEmail('');
        $user->setPassword('1234');
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

    #[Route('/user/{id<\d+>}', name: 'user_show')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Pas d\'utilisateur pour l\'id' . $id);
        }

        return new Response('Utilisater :' . $user->getName());
    }
}
