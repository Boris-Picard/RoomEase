<?php

namespace App\Repository;

use App\Model\Books;
use App\Model\BookStatusEnum;

class BooksRepository
{
    public function getAllBooks(): array
    {
        return [new Books(1, '1984', 'George Orwell', 1949, 'Dystopian', BookStatusEnum::PUBLISHED), new Books(2, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'Fiction', BookStatusEnum::COMPLETED), new Books(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Classic', BookStatusEnum::REVIEWED)];
    }

    public function find(int $id): ?Books
    {
        foreach ($this->getAllBooks() as $book) {
            if ($book->getId() === $id) {
                return $book;
            }
        }
        return null;
    }
}
