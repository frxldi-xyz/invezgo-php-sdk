<?php

/**
 * Basic Usage Examples
 * 
 * This file demonstrates basic usage of the Invezgo PHP SDK
 */

require __DIR__ . '/../vendor/autoload.php';

use Invezgo\InvezgoClient;
use Invezgo\Exception\ApiException;
use Invezgo\Exception\AuthenticationException;
use Invezgo\Exception\PaymentRequiredException;
use Invezgo\Exception\RateLimitException;

// Replace with your actual API key
$apiKey = 'your-api-key-here';

try {
    // Initialize the client
    $client = new InvezgoClient($apiKey);

    // Example 1: Get list of stocks
    echo "=== Example 1: Get Stock List ===\n";
    $stocks = $client->analysis()->getStockList();
    echo "Total stocks: " . count($stocks) . "\n";
    if (!empty($stocks)) {
        echo "First stock: " . json_encode($stocks[0], JSON_PRETTY_PRINT) . "\n";
    }
    echo "\n";

    // Example 2: Get company information
    echo "=== Example 2: Get Company Information ===\n";
    $info = $client->analysis()->information('BBCA');
    echo "Company: " . ($info['name'] ?? 'N/A') . "\n";
    echo "Sector: " . ($info['sector'] ?? 'N/A') . "\n";
    echo "\n";

    // Example 3: Get top gainer & loser
    echo "=== Example 3: Get Top Gainer & Loser ===\n";
    $date = date('Y-m-d'); // Today's date
    $topChange = $client->analysis()->topChange($date);
    if (!empty($topChange['gain'])) {
        echo "Top Gainer: " . json_encode($topChange['gain'][0] ?? [], JSON_PRETTY_PRINT) . "\n";
    }
    if (!empty($topChange['loss'])) {
        echo "Top Loser: " . json_encode($topChange['loss'][0] ?? [], JSON_PRETTY_PRINT) . "\n";
    }
    echo "\n";

    // Example 4: Get intraday chart
    echo "=== Example 4: Get Intraday Chart ===\n";
    $intraday = $client->analysis()->getIntradayChart('BBCA', 'RG');
    echo "Intraday data points: " . count($intraday) . "\n";
    echo "\n";

    // Example 5: Health check
    echo "=== Example 5: Health Check ===\n";
    $health = $client->health()->check();
    echo "API Status: " . json_encode($health, JSON_PRETTY_PRINT) . "\n";
    echo "\n";

} catch (AuthenticationException $e) {
    echo "Authentication Error: " . $e->getMessage() . "\n";
    echo "Please check your API key.\n";
} catch (PaymentRequiredException $e) {
    echo "Payment Required: " . $e->getMessage() . "\n";
    echo "Your subscription package may be insufficient or expired.\n";
} catch (RateLimitException $e) {
    echo "Rate Limit Exceeded: " . $e->getMessage() . "\n";
    echo "Please wait before making another request.\n";
} catch (ApiException $e) {
    echo "API Error: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

