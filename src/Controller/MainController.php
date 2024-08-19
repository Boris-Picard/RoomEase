<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $number = random_int(0, 100);

        $myNumber = ['favorite' => 11, 'notFavorite' => 50];

        return $this->render('main/homepage.html.twig', [
            'number' => $number,
            'myNumber' => $myNumber,
        ]);
    }
}
