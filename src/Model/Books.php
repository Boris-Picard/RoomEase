<?php

namespace App\Model;

class Books
{
    private int $id;
    private string $title;
    private string $author;
    private int $year;
    private string $genre;
    private BookStatusEnum $status;
    public function __construct(int $id,  string $title,  string $author,  int $year,  string $genre, BookStatusEnum $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
        $this->status = $status;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getStatus(): BookStatusEnum
    {
        return $this->status;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    public function setStatus(BookStatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatusString(): string
    {
        return $this->status->value;
    }
}
