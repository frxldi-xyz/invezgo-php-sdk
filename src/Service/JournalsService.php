<?php

namespace Invezgo\Service;

/**
 * Journals Service - Personal
 */
class JournalsService extends BaseService
{
    /**
     * Extract journal from file
     *
     * @param array $data File data
     * @return array
     */
    public function extractInformation(array $data): array
    {
        return $this->client->post('/journals/file', $data);
    }

    /**
     * Add new journal transaction
     *
     * @param array $data Transaction data
     * @return array
     */
    public function addTransaction(array $data): array
    {
        return $this->client->post('/journals', $data);
    }

    /**
     * List journal transactions
     *
     * @return array
     */
    public function listTransactions(): array
    {
        return $this->client->get('/journals');
    }

    /**
     * Delete journal
     *
     * @param array $data Delete data
     * @return array
     */
    public function deleteWatchlists(array $data): array
    {
        return $this->client->delete('/journals', $data);
    }

    /**
     * Get transactions summary
     *
     * @return array
     */
    public function getTransactionsSummary(): array
    {
        return $this->client->get('/journals/summary');
    }

    /**
     * Update journal transaction note
     *
     * @param string $id Journal ID
     * @param array $data Note data
     * @return array
     */
    public function updateNoteWatchlist(string $id, array $data): array
    {
        return $this->client->patch("/journals/{$id}", $data);
    }
}

