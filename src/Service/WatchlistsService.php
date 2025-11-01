<?php

namespace Invezgo\Service;

/**
 * Watchlists Service - Personal
 */
class WatchlistsService extends BaseService
{
    /**
     * Get list of watchlists
     *
     * @param string $group Watchlist group from /watchlists/group
     * @return array
     */
    public function listWatchlist(string $group): array
    {
        return $this->client->get('/watchlists', ['group' => $group]);
    }

    /**
     * Add new stock to watchlist
     *
     * @param array $data Watchlist data
     * @return array
     */
    public function addWatchlist(array $data): array
    {
        return $this->client->post('/watchlists', $data);
    }

    /**
     * Delete watchlist
     *
     * @param array $data Delete data
     * @return array
     */
    public function deleteWatchlists(array $data): array
    {
        return $this->client->delete('/watchlists', $data);
    }

    /**
     * Get list of watchlist groups
     *
     * @return array
     */
    public function listGroupWatchlist(): array
    {
        return $this->client->get('/watchlists/group');
    }

    /**
     * Add new group to watchlist
     *
     * @param array $data Group data
     * @return array
     */
    public function addGroupWatchlist(array $data): array
    {
        return $this->client->post('/watchlists/group', $data);
    }

    /**
     * Update watchlist
     *
     * @param string $id Watchlist ID
     * @param array $data Update data
     * @return array
     */
    public function updateWatchlist(string $id, array $data): array
    {
        return $this->client->put("/watchlists/{$id}", $data);
    }

    /**
     * Update watchlist note
     *
     * @param string $id Watchlist ID
     * @param array $data Note data
     * @return array
     */
    public function updateNoteWatchlist(string $id, array $data): array
    {
        return $this->client->patch("/watchlists/{$id}", $data);
    }
}

