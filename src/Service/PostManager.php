<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class PostManager
{
    private const TOTAL_ITEM_PER_PAGE = 5;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer,
        private PostRepository $postRepository,
    )
    {
    }

    public function getPosts($page = 1) {
        $offset = ($page > 1) ? ($page-1) * self::TOTAL_ITEM_PER_PAGE: 0;
        $posts = $this->postRepository->findBy(
            [],
            null,
            self::TOTAL_ITEM_PER_PAGE,
            $offset
        );

        return $this->serializer->serialize($posts, 'json');
    }

    public function createPost(string $requestData): string
    {
        $post = $this->serializer->deserialize($requestData, Post::class, 'json');
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $this->serializer->serialize($post, 'json');
    }

    public function updatePost(Post $post, string $requestData)
    {
        $updatedPost = $this->serializer->deserialize(
            $requestData,
            Post::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $post]
        );

        $this->entityManager->persist($updatedPost);
        $this->entityManager->flush();
    }

    public function deletePost(Post $post) {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}