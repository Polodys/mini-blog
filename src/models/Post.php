<?php

namespace Application\Models;

class Post
{
    private ?int $id;
    private string $title;
    private string $content;
    private string $authorId;
    private ?string $authorEmail;
    private ?string $authorPseudonym;
    private ?string $creationDate;

    public function __construct(?int $id, string $title, string $content, string $authorId, ?string $authorEmail, ?string $authorPseudonym, ?string $creationDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->authorEmail = $authorEmail;
        $this->authorPseudonym = $authorPseudonym;
        $this->creationDate = $creationDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    public function getAuthorPseudonym()
    {
        return $this->authorPseudonym;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }
}