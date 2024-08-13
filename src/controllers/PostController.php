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

    public function createPost(array $data)
    {
        try {
            // 1- Datas validation
            $title = trim($data['title']);
            $content = trim($data['content']);
            $authorId = $_SESSION['authorId'] ?? null;
            $authorEmail = $_SESSION['authorEmail'] ?? null;
            $authorPseudonym = $_SESSION['authorPseudonym'] ?? null;

            if (empty($title) || empty($content)) {
                throw new \Exception("Le titre et le contenu ne peuvent être vides.", 400);
            }

            if (empty($authorId)) {
                throw new \Exception("Auteur non authentifié.", 403);
            }

            // 2- Creation of the new post
            $post = new Post(null, $title, $content, $authorId, $authorEmail, $authorPseudonym, null);
            $this->postRepository->createPost($post);
            header('Location: index.php');
            exit();
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function homepage()
    {
        try {
            $posts = $this->postRepository->getAllPosts();
            require 'src/views/homepage.php';
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function showOnePost(int $id)
    {
        try {
            $post = $this->postRepository->getOnePost($id);
            require 'src/views/posts/show-one-post.php';
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function updatePostForm(int $id)
    {
        try {
            $post = $this->postRepository->getOnePost($id);
            require 'src/views/posts/update-post-form.php';
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function updatePost(int $id, array $data)
    {
        try {
            // 1- Datas validation
            $title = trim($data['title']);
            $content = trim($data['content']);
            $post = $this->postRepository->getOnePost($id);

            if (empty($title) || empty($content)) {
                throw new \Exception("Le titre et le contenu ne peuvent pas être vides.");
            }

            // Only the author of a post can modify it : here, an exception is thrown if the connected author is not the author of the post
            if ((int) $_SESSION['authorId'] !== (int) $post->getAuthorId()) {
                throw new \Exception("Vous n'avez pas les droits pour modifier ce billet.");
            }

            // 2- Updating of the post
            $post = $this->postRepository->updatePost($id, $title, $content);
            header('Location: index.php?action=show-one-post&id=' . $id);
            exit();
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    public function deletePost(int $id)
    {
        try {
            // Only the author of a post can delete it : here, an exception is thrown if the connected author is not the author of the post
            $post = $this->postRepository->getOnePost($id);
            if ((int) $_SESSION['authorId'] !== (int) $post->getAuthorId()) {
                throw new \Exception("Vous n'avez pas les droits pour supprimer ce billet.");
            }

            try {
                $this->postRepository->deletePost($id);
                header('Location: index.php');
                exit();
            } catch (\Exception $e) {
                throw new \Exception("Erreur lors de la suppression du billet.");
            }
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }
}
