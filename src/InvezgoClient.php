<?php

namespace Invezgo;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Invezgo\Exception\ApiException;
use Invezgo\Exception\AuthenticationException;
use Invezgo\Exception\PaymentRequiredException;
use Invezgo\Exception\RateLimitException;

/**
 * Main Invezgo API Client
 * 
 * @package Invezgo
 */
class InvezgoClient
{
    /**
     * @var string Base URL for Invezgo API
     */
    private string $baseUrl;

    /**
     * @var string API Key for authentication
     */
    private string $apiKey;

    /**
     * @var Client HTTP Client instance
     */
    private Client $httpClient;

    /**
     * @var array Services instances
     */
    private array $services = [];

    /**
     * @param string $apiKey Your Invezgo API Key
     * @param string|null $baseUrl Optional base URL (defaults to production)
     */
    public function __construct(string $apiKey, ?string $baseUrl = null)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl ?? 'https://api.invezgo.com';
        
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 30.0,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Make HTTP GET request
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function get(string $endpoint, array $params = []): array
    {
        try {
            $response = $this->httpClient->get($endpoint, [
                'query' => $params,
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            $this->handleException($e);
            throw new ApiException('Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make HTTP POST request
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws ApiException
     */
    public function post(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->httpClient->post($endpoint, [
                'json' => $data,
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            $this->handleException($e);
            throw new ApiException('Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make HTTP PUT request
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws ApiException
     */
    public function put(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->httpClient->put($endpoint, [
                'json' => $data,
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            $this->handleException($e);
            throw new ApiException('Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make HTTP PATCH request
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws ApiException
     */
    public function patch(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->httpClient->patch($endpoint, [
                'json' => $data,
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            $this->handleException($e);
            throw new ApiException('Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make HTTP DELETE request
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function delete(string $endpoint, array $params = []): array
    {
        try {
            $response = $this->httpClient->delete($endpoint, [
                'query' => $params,
                'json' => $params,
            ]);

            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            $this->handleException($e);
            throw new ApiException('Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Handle HTTP response
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array
     * @throws ApiException
     */
    private function handleResponse($response): array
    {
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        if ($statusCode === 204) {
            return [];
        }

        if ($statusCode >= 400) {
            $this->handleErrorResponse($statusCode, $body);
        }

        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiException('Invalid JSON response: ' . json_last_error_msg());
        }

        return $data ?? [];
    }

    /**
     * Handle error responses
     *
     * @param int $statusCode
     * @param string $body
     * @throws ApiException
     */
    private function handleErrorResponse(int $statusCode, string $body): void
    {
        $data = json_decode($body, true);
        $message = $data['message'] ?? 'An error occurred';
        $error = $data['error'] ?? 'Unknown error';

        switch ($statusCode) {
            case 401:
                throw new AuthenticationException($message);
            case 402:
                throw new PaymentRequiredException($message);
            case 429:
                throw new RateLimitException($message);
            default:
                throw new ApiException($message, $statusCode);
        }
    }

    /**
     * Handle Guzzle exceptions
     *
     * @param GuzzleException $e
     * @throws ApiException
     */
    private function handleException(GuzzleException $e): void
    {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $this->handleErrorResponse($statusCode, $body);
        }
    }

    /**
     * Get Analysis service
     *
     * @return Service\AnalysisService
     */
    public function analysis(): Service\AnalysisService
    {
        if (!isset($this->services['analysis'])) {
            $this->services['analysis'] = new Service\AnalysisService($this);
        }

        return $this->services['analysis'];
    }

    /**
     * Get Watchlists service
     *
     * @return Service\WatchlistsService
     */
    public function watchlists(): Service\WatchlistsService
    {
        if (!isset($this->services['watchlists'])) {
            $this->services['watchlists'] = new Service\WatchlistsService($this);
        }

        return $this->services['watchlists'];
    }

    /**
     * Get Journals service
     *
     * @return Service\JournalsService
     */
    public function journals(): Service\JournalsService
    {
        if (!isset($this->services['journals'])) {
            $this->services['journals'] = new Service\JournalsService($this);
        }

        return $this->services['journals'];
    }

    /**
     * Get Portfolios service
     *
     * @return Service\PortfoliosService
     */
    public function portfolios(): Service\PortfoliosService
    {
        if (!isset($this->services['portfolios'])) {
            $this->services['portfolios'] = new Service\PortfoliosService($this);
        }

        return $this->services['portfolios'];
    }

    /**
     * Get AI service
     *
     * @return Service\AiService
     */
    public function ai(): Service\AiService
    {
        if (!isset($this->services['ai'])) {
            $this->services['ai'] = new Service\AiService($this);
        }

        return $this->services['ai'];
    }

    /**
     * Get Search service
     *
     * @return Service\SearchService
     */
    public function search(): Service\SearchService
    {
        if (!isset($this->services['search'])) {
            $this->services['search'] = new Service\SearchService($this);
        }

        return $this->services['search'];
    }

    /**
     * Get Profile service
     *
     * @return Service\ProfileService
     */
    public function profile(): Service\ProfileService
    {
        if (!isset($this->services['profile'])) {
            $this->services['profile'] = new Service\ProfileService($this);
        }

        return $this->services['profile'];
    }

    /**
     * Get Membership service
     *
     * @return Service\MembershipService
     */
    public function membership(): Service\MembershipService
    {
        if (!isset($this->services['membership'])) {
            $this->services['membership'] = new Service\MembershipService($this);
        }

        return $this->services['membership'];
    }

    /**
     * Get Posts service
     *
     * @return Service\PostsService
     */
    public function posts(): Service\PostsService
    {
        if (!isset($this->services['posts'])) {
            $this->services['posts'] = new Service\PostsService($this);
        }

        return $this->services['posts'];
    }

    /**
     * Get Recommendation service
     *
     * @return Service\RecommendationService
     */
    public function recommendation(): Service\RecommendationService
    {
        if (!isset($this->services['recommendation'])) {
            $this->services['recommendation'] = new Service\RecommendationService($this);
        }

        return $this->services['recommendation'];
    }

    /**
     * Get Trades service
     *
     * @return Service\TradesService
     */
    public function trades(): Service\TradesService
    {
        if (!isset($this->services['trades'])) {
            $this->services['trades'] = new Service\TradesService($this);
        }

        return $this->services['trades'];
    }

    /**
     * Get Screener service
     *
     * @return Service\ScreenerService
     */
    public function screener(): Service\ScreenerService
    {
        if (!isset($this->services['screener'])) {
            $this->services['screener'] = new Service\ScreenerService($this);
        }

        return $this->services['screener'];
    }

    /**
     * Get Health service
     *
     * @return Service\HealthService
     */
    public function health(): Service\HealthService
    {
        if (!isset($this->services['health'])) {
            $this->services['health'] = new Service\HealthService($this);
        }

        return $this->services['health'];
    }
}
