<?php

namespace Invezgo\Service;

/**
 * Portfolios Service - Personal
 */
class PortfoliosService extends BaseService
{
    /**
     * List portfolios
     *
     * @return array
     */
    public function listPortfolio(): array
    {
        return $this->client->get('/portfolios');
    }

    /**
     * Get portfolio summary
     *
     * @return array
     */
    public function portfolioSummary(): array
    {
        return $this->client->get('/portfolios/summary');
    }
}

