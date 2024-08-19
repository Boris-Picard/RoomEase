<?php

namespace App\Controller;

use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(BooksRepository $booksRepository): Response
    {
        $books = $booksRepository->getAllBooks();
        $myBook = $books[array_rand($books)];

        return $this->render('main/homepage.html.twig', [
            'myBook' => $myBook,
            'books' => $books,
        ]);
    }
}
