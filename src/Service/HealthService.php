<?php

namespace Invezgo\Service;

/**
 * Health Service - Status
 */
class HealthService extends BaseService
{
    /**
     * Check API status
     *
     * @return array
     */
    public function check(): array
    {
        return $this->client->get('/health');
    }

    /**
     * Check database status
     *
     * @return array
     */
    public function checkDatabase(): array
    {
        return $this->client->get('/health/database');
    }

    /**
     * Check API and database status
     *
     * @return array
     */
    public function fullCheck(): array
    {
        return $this->client->get('/health/full');
    }
}

