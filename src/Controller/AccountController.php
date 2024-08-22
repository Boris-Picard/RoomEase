<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'create_account')]
    public function createAccount(EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $existingAccount = $entityManager->getRepository(User::class)
            ->findOneBy(['email' => 'boris2@gmail.com']);

        if ($existingAccount) {
            throw new Exception('L\'utilisateur existe déjà avec cet email');
        }

        $account = new User();
        $account->setName('Boris');
        $account->setEmail('');
        $account->setPassword('1234');
        $account->setStatus(0);
        $account->setCreatedAt(new \DateTime());
        $account->setUpdatedAt(new \DateTime());

        $errors = $validator->validate($account);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $entityManager->persist($account);

        $entityManager->flush();

        return new Response('Saved new account with id :' . $account->getId());
    }
}
