<?php

namespace App\Controller\API;

use App\Entity\Post;
use App\Service\PostManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/post', name: 'post_')]
class PostController extends AbstractController
{
    #[Route('/list/{page}', name: 'list', methods: 'GET')]
    public function listAction(PostManager $postManager, int $page = 1): JsonResponse
    {
        $posts = $postManager->getPosts($page);

        return new JsonResponse($posts, Response::HTTP_OK, [], true);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/create', name: 'create', methods: 'POST')]
    public function createAction(PostManager $postManager, Request $request): JsonResponse
    {
        $postManager->createPost($request->getContent());

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/update/{id}', name: 'update', methods: 'PUT')]
    public function updateAction(Request $request, PostManager $postManager, Post $post): JsonResponse
    {
        $postManager->updatePost($post, $request->getContent());

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/{id}', name: 'delete', methods: 'DELETE')]
    public function deleteAction(PostManager $postManager, Post $post): JsonResponse
    {
        $postManager->deletePost($post);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}