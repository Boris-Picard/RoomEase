<?php

namespace App\Controller;

use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/books')]
class ApiBooksController extends AbstractController
{
    #[Route('', methods: ['GET'])]

    public function getBooks(BooksRepository $booksRepository): Response
    {
        $books = $booksRepository->getAllBooks();
        return $this->json($books);
    }

    // #[Route('', methods: ['POST'])]
    // public function create() {}

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id, BooksRepository $booksRepository): Response
    {
        $book = $booksRepository->find($id);
        
        if(!$book) {
            throw $this->createNotFoundException('Livre non trouvé');
        }

        return $this->json($book);
    }
}
