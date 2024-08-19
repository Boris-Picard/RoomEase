<?php

namespace App\Controller;

use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiBooksController extends AbstractController
{
    #[Route('api/books')]

    public function getBooks(BooksRepository $booksRepository): Response
    {
        $books = $booksRepository->getAllBooks();
        return $this->json($books);
    }
}
