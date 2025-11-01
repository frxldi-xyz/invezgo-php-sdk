<?php

namespace Invezgo\Service;

/**
 * Recommendation Service
 */
class RecommendationService extends BaseService
{
    /**
     * Get user recommendations
     *
     * @return array
     */
    public function userRecommendations(): array
    {
        return $this->client->get('/recommendation/user');
    }
}

