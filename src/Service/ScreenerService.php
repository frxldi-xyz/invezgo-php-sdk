<?php

namespace Invezgo\Service;

/**
 * Screener Service
 */
class ScreenerService extends BaseService
{
    /**
     * Get list of screener presets
     *
     * @return array
     */
    public function list(): array
    {
        return $this->client->get('/screener');
    }

    /**
     * Save screener preset
     *
     * @param array $data Screener data
     * @return array
     */
    public function save(array $data): array
    {
        return $this->client->post('/screener', $data);
    }

    /**
     * Run screener
     *
     * @param array $data Screen data
     * @return array
     */
    public function screen(array $data): array
    {
        return $this->client->post('/screener/screen', $data);
    }
}

