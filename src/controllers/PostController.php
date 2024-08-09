<?php

namespace Application\Controllers;

require_once 'src/models/PostRepository.php';

use Application\Models\PostRepository;

class PostController
{
    private PostRepository $PostRepository;

    public function __construct()
    {
        $this->PostRepository = new PostRepository();
    }

    public function index()
    {
        $posts = $this->PostRepository->getAll();
        require 'src/views/homepage.php';
    }
}