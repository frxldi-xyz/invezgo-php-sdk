<?php

namespace Invezgo\Service;

/**
 * Search Service
 */
class SearchService extends BaseService
{
    /**
     * Search stock or user
     *
     * @param string $query Search query
     * @return array
     */
    public function search(string $query): array
    {
        return $this->client->get('/search', ['query' => $query]);
    }

    /**
     * Search stock
     *
     * @param string $query Search query
     * @param string $cursor Cursor for pagination
     * @return array
     */
    public function searchStock(string $query, string $cursor): array
    {
        return $this->client->get('/search/stock', [
            'query' => $query,
            'cursor' => $cursor,
        ]);
    }

    /**
     * Search user
     *
     * @param string $query Search query
     * @param string $cursor Cursor for pagination
     * @return array
     */
    public function searchUser(string $query, string $cursor): array
    {
        return $this->client->get('/search/user', [
            'query' => $query,
            'cursor' => $cursor,
        ]);
    }
}

