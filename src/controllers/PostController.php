<?php

namespace Application\Controllers;

require_once 'src/models/PostRepository.php';

use Application\Models\ModelPostRepository;

class PostController
{
    private ModelPostRepository $modelPostRepository;

    public function __construct()
    {
        $this->modelPostRepository = new ModelPostRepository();
    }

    public function index()
    {
        $posts = $this->modelPostRepository->getAll();
        require 'src/views/homepage.php';
    }
}