<?php

namespace App\Controller;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'create_account')]
    public function createAccount(EntityManagerInterface $entityManager): Response
    {
        $account = new Account();
        $account->setEmail('boris2@gmail.com');
        $account->setPassword('1234');
        $account->setStatus(1);
        $account->setCreatedAt(new \DateTime());
        $account->setUpdatedAt(new \DateTime());

        $entityManager->persist($account);

        $entityManager->flush();

        return new Response('Saved new account with id :' . $account->getId());
    }
}
