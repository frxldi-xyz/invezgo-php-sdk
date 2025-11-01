<?php

namespace Invezgo\Service;

/**
 * Trades Service - Personal
 */
class TradesService extends BaseService
{
    /**
     * List realized transactions
     *
     * @return array
     */
    public function listTransactions(): array
    {
        return $this->client->get('/trades');
    }

    /**
     * Delete realized transactions
     *
     * @param array $data Delete data
     * @return array
     */
    public function deleteWatchlists(array $data): array
    {
        return $this->client->delete('/trades', $data);
    }

    /**
     * Get transactions summary
     *
     * @return array
     */
    public function getTransactionsSummary(): array
    {
        return $this->client->get('/trades/summary');
    }

    /**
     * Get summary chart
     *
     * @return array
     */
    public function getSummaryChart(): array
    {
        return $this->client->get('/trades/summary-chart');
    }

    /**
     * Update trade note
     *
     * @param string $id Trade ID
     * @param array $data Note data
     * @return array
     */
    public function updateNoteWatchlist(string $id, array $data): array
    {
        return $this->client->patch("/trades/{$id}", $data);
    }
}

