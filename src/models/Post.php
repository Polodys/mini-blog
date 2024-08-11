<?php

namespace Application\Models;

class Post
{
    private ?int $id;
    private string $title;
    private string $content;
    private string $authorId;
    private ?string $creationDate;

    public function __construct(?int $id, string $title, string $content, string $authorId, ?string $creationDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
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

    public function getCreationDate()
    {
        return $this->creationDate;
    }
}