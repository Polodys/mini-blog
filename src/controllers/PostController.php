<?php

namespace Application\Controllers;

require_once 'src/models/Post.php';
require_once 'src/models/PostRepository.php';

use Application\Models\Post;
use Application\Models\PostRepository;

class PostController
{
    private PostRepository $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function createPostForm()
    {
        require 'src/views/posts/create-post-form.php';
    }

    public function createPost($title, $content, $authorId)
    {
        try {
            $post = new Post(null, $title, $content, $authorId, null);
            $this->postRepository->createPost($post);
            header('Location: index.php');
        } catch (\Exception $e) {
            $errorMessage = "Une erreur eset survenue lors de la création du billet.";
            require 'src/views/posts/create-post-form.php';
        }
    }

    public function index()
    {
        $posts = $this->postRepository->getAllPosts();
        require 'src/views/homepage.php';
    }

    public function showOnePost(int $id)
    {
        $post = $this->postRepository->getOnePost($id);
        require 'src/views/posts/show-one-post.php';
    }

    public function updatePostForm(int $id)
    {
        $post = $this->postRepository->getOnePost($id);
        require 'src/views/posts/update-post-form.php';
    }

    public function updatePost(int $id, string $title, string $content)
    {
        // Only the author of a post can modify it : here, an exception is thrown if the connected author is not the author of the post
        $post = $this->postRepository->getOnePost($id);
        if ((int) $_SESSION['author_id'] !== (int) $post->getAuthorId()) {
            throw new \Exception("Vous n'avez pas les droits pour modifier ce billet.");
        }
        
        $post = $this->postRepository->updatePost($id, $title, $content);
        header('Location: index.php?action=show-one-post&id=' . $id);
    }

    public function deletePost(int $id)
    {
        // Only the author of a post can delete it : here, an exception is thrown if the connected author is not the author of the post
        $post = $this->postRepository->getOnePost($id);
        if ((int) $_SESSION['author_id'] !== (int) $post->getAuthorId()) {
            throw new \Exception("Vous n'avez pas les droits pour supprimer ce billet.");
        }

        $this->postRepository->deletePost($id);
        header('Location: index.php');
    }
}