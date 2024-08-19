<?php

namespace App\Controller;

use App\Model\Books;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiBooksController extends AbstractController
{
    #[Route('api/books')]

    public function getBooks(): Response
    {
        $books = [new Books(1, '1984', 'George Orwell', 1949, 'Dystopian'), new Books(2, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'Fiction'), new Books(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Classic')];

        return $this->json($books);
    }
}
