<?php

namespace Invezgo\Service;

/**
 * Posts Service
 */
class PostsService extends BaseService
{
    /**
     * Get all posts
     *
     * @return array
     */
    public function getPosts(): array
    {
        return $this->client->get('/posts');
    }

    /**
     * Get posts by category
     *
     * @param string $category Category
     * @return array
     */
    public function getCategoryPosts(string $category): array
    {
        return $this->client->get("/posts/category/{$category}");
    }

    /**
     * Get stock posts
     *
     * @param string $code Stock code
     * @return array
     */
    public function getStockPosts(string $code): array
    {
        return $this->client->get("/posts/space/{$code}");
    }

    /**
     * Get stock posts by category
     *
     * @param string $code Stock code
     * @param string $category Category
     * @return array
     */
    public function getStockCategoryPosts(string $code, string $category): array
    {
        return $this->client->get("/posts/space/category/{$code}/{$category}");
    }

    /**
     * Get post by ID
     *
     * @param string $id Post ID
     * @return array
     */
    public function getPostById(string $id): array
    {
        return $this->client->get("/posts/detail/{$id}");
    }

    /**
     * Get post comments
     *
     * @param string $id Post ID
     * @return array
     */
    public function getComment(string $id): array
    {
        return $this->client->get("/posts/comment/{$id}");
    }

    /**
     * Get liked posts
     *
     * @return array
     */
    public function getLike(): array
    {
        return $this->client->get('/posts/like');
    }

    /**
     * Get favorite posts
     *
     * @return array
     */
    public function getFavorite(): array
    {
        return $this->client->get('/posts/favorite');
    }

    /**
     * Get post voters
     *
     * @param string $id Post ID
     * @return array
     */
    public function getVoters(string $id): array
    {
        return $this->client->get("/posts/vote/{$id}");
    }
}

