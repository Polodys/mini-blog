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
        // 1- Datas validation
        $title = trim($data['title']);
        $content = trim($data['content']);
        $authorId = $_SESSION['authorId'] ?? null;
        $authorEmail = $_SESSION['authorEmail'] ?? null;
        $authorPseudonym = $_SESSION['authorPseudonym'] ?? null;

        if (empty($title) || empty($content)) {
            $errorMessage = "Le titre et le contenu ne peuvent pas être vides.";
            require 'src/views/posts/create-post-form.php';
            return;
        }

        if (empty($authorId)) {
            throw new \Exception("Vous devez être connecté pour créer un billet.");
        }

        // 2- Creation of the new post
        try {
            $post = new Post(null, $title, $content, $authorId, $authorEmail, $authorPseudonym, null);
            $this->postRepository->createPost($post);
            header('Location: index.php');
        } catch (\Exception $e) {
            $errorMessage = "Une erreur eset survenue lors de la création du billet.";
            require 'src/views/posts/create-post-form.php';
        }
    }

    public function homepage()
    {
        $posts = $this->postRepository->getAllPosts();
        // echo "<pre>";var_dump($posts);die;
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

    public function updatePost(int $id, array $data)
    {
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
        try {
            $post = $this->postRepository->updatePost($id, $title, $content);
            header('Location: index.php?action=show-one-post&id=' . $id);
        } catch (\Exception $e) {
            $errorMessage = "Une erreur est survenue lors de la mise à jour du billet.";
            require 'src\views\posts\update-post-form.php';
        }
    }

    public function deletePost(int $id)
    {
        // Only the author of a post can delete it : here, an exception is thrown if the connected author is not the author of the post
        $post = $this->postRepository->getOnePost($id);
        if ((int) $_SESSION['authorId'] !== (int) $post->getAuthorId()) {
            throw new \Exception("Vous n'avez pas les droits pour supprimer ce billet.");
        }

        try {
            $this->postRepository->deletePost($id);
            header('Location: index.php');
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la suppression du billet.");
        }
    }
}
