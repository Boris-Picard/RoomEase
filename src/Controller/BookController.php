<?php

namespace App\Controller;

use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{

    #[Route('/book/{id<\d+>}', name: 'app_book_show')]
    public function show(int $id, BooksRepository $booksRepository): Response
    {
        $book = $booksRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Livre non trouvé');
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }
}
