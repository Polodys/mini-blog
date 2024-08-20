<?php

namespace Application\Controllers;

require_once 'src/models/Post.php';
require_once 'src/models/PostRepository.php';
require_once 'src/lib/functions.php';

use Application\Models\Post;
use Application\Models\PostRepository;

/**
 * Controller that handles the operations on the posts
 */
class PostController
{
    private PostRepository $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    /**
     * Displays the form for creating a new post
     */
    public function createPostForm()
    {
        require 'src/views/posts/create-post-form.php';
    }

    /**
     * Creates a new post with the datas received
     *
     * @param array $data Datas received from the form
     */
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
            header('Location: index.php?execution=post/homepage');
            exit();
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    /**
     * Displays homepage, with the list of all blogs
     */
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

    /**
     * Displays the specified post
     *
     * @param integer $id The identifier of the post to display
     */
    public function showOnePost(int $id)
    {
        try {
            $id = validateId($id);
            $post = $this->postRepository->getOnePost($id);
            require 'src/views/posts/show-one-post.php';
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    /**
     * Displays the form for updating a post
     *
     * @param integer $id The identifier of the post to update
     */
    public function updatePostForm(int $id)
    {
        try {
            $id = validateId($id);
            $post = $this->postRepository->getOnePost($id);
            require 'src/views/posts/update-post-form.php';
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    /**
     * Updates a post with the new datas received
     *
     * @param array $data Datas received from the form
     */
    public function updatePost(array $data)
    {
        try {
            // 1- Datas validation
            $id = validateId($data['id']);
            $title = trim($data['title']);
            $content = trim($data['content']);

            if (empty($title) || empty($content)) {
                throw new \Exception("Le titre et le contenu ne peuvent pas être vides.");
            }

            // Checks if the connected author is the author of the post
            $post = $this->postRepository->getOnePost($id);
            if ((int) $_SESSION['authorId'] !== (int) $post->getAuthorId()) {
                throw new \Exception("Vous n'avez pas les droits pour modifier ce billet.");
            }

            // 2- Updating of the post
            $post = $this->postRepository->updatePost($id, $title, $content);
            $url = 'index.php?execution=post/showOnePost/'.$id;
            header('Location: ' . $url);            
            exit();
        } catch (\Exception $e) {
            $errorController = new ErrorController();
            $errorController->errorHandler($e);
        }
    }

    /**
     * Deletes the specified post
     *
     * @param integer $id The identifier of the post to delete
     */
    public function deletePost(int $id)
    {
        try {            
            $id = validateId($id);

            // Checks if the connected author is the author of the post
            $post = $this->postRepository->getOnePost($id);
            if ((int) $_SESSION['authorId'] !== (int) $post->getAuthorId()) {
                throw new \Exception("Vous n'avez pas les droits pour supprimer ce billet.");
            }

            try {
                $id = validateId($id);
                $this->postRepository->deletePost($id);
                header('Location: index.php?execution=post/homepage');
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
