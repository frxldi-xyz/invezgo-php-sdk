# Invezgo PHP SDK

Official PHP SDK for [Invezgo API](https://invezgo.com) - Data Saham Indonesia

[![PHP Version](https://img.shields.io/badge/php-7.4%2B-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

## Installation

Install via Composer:

```bash
composer require invezgo/invezgo-php-sdk
```

## Requirements

- PHP 7.4 or higher
- Guzzle HTTP Client 6.0 or higher

## Getting Started

### Basic Usage

```php
<?php

require 'vendor/autoload.php';

use Invezgo\InvezgoClient;

// Initialize the client with your API key
$client = new InvezgoClient('your-api-key-here');

// Get list of stocks
$stocks = $client->analysis()->getStockList();
print_r($stocks);

// Get company information
$info = $client->analysis()->information('BBCA');
print_r($info);
```

### Authentication

You need an API key to use this SDK. Get your API key from [Invezgo API Settings](https://invezgo.com/id/setting/api).

**Note:** You must have an active subscription package to use the API.

## Usage Examples

### Analysis Service - Data Saham Indonesia

#### Get Stock List

```php
$stocks = $client->analysis()->getStockList();
// Returns: [{"code":"BBCA","name":"Bank Central Asia","logo":"..."}, ...]
```

#### Get Company Information

```php
$info = $client->analysis()->information('BBCA');
```

#### Get Top Gainer & Loser

```php
$topChange = $client->analysis()->topChange('2024-12-30');
```

#### Get Stock Chart

```php
$chart = $client->analysis()->getAdvanceChart('BBCA', '2024-12-01', '2024-12-30');
```

#### Get Intraday Chart

```php
$intraday = $client->analysis()->getIntradayChart('BBCA', 'RG');
```

#### Get Financial Statement

```php
// Balance Sheet (BS), Income Statement (IS), Cash Flow (CF)
// Period: FY (Annual), Q (Quarterly), Q1-Q4 (Specific Quarter)
$financial = $client->analysis()->financialStatement('BBCA', 'BS', 'Q', 10);
```

#### Get Broker Summary

```php
$summary = $client->analysis()->summaryStock(
    'BBCA',                    // Stock code
    '2024-12-01',              // From date
    '2024-12-30',              // To date
    'all',                     // Investor: all, f (foreign), d (domestic)
    'RG'                       // Market: RG (Regular), NG (Negotiated), TN (Cash)
);
```

#### Get Shareholder Data

```php
// Get shareholder composition
$shareholder = $client->analysis()->shareholder('BBCA');

// Get KSEI shareholder data
$ksei = $client->analysis()->shareholderKSEI('BBCA', 6); // 6 months

// Get insider trading
$insider = $client->analysis()->insider('2024-12-01', '2024-12-30', 10, 1);
```

### Watchlists Service - Personal

```php
// Get watchlist groups
$groups = $client->watchlists()->listGroupWatchlist();

// Get watchlists
$watchlists = $client->watchlists()->listWatchlist('group-id');

// Add to watchlist
$result = $client->watchlists()->addWatchlist([
    'stock_code' => 'BBCA',
    'group_id' => 'group-id',
    // ... other fields
]);
```

### Journals Service - Personal

```php
// List journal transactions
$journals = $client->journals()->listTransactions();

// Add journal transaction
$result = $client->journals()->addTransaction([
    'stock_code' => 'BBCA',
    'transaction_type' => 'buy',
    'price' => 10000,
    'quantity' => 100,
    // ... other fields
]);

// Get summary
$summary = $client->journals()->getTransactionsSummary();
```

### Portfolios Service - Personal

```php
// List portfolios
$portfolios = $client->portfolios()->listPortfolio();

// Get portfolio summary
$summary = $client->portfolios()->portfolioSummary();
```

### AI Service - AI Chat

```php
// AI analysis for KSEI shareholder
$analysis = $client->ai()->shareholderKSEI('BBCA');

// AI analysis for news
$news = $client->ai()->news('BBCA');

// AI analysis for broker summary
$analysis = $client->ai()->brokerSummary('BBCA', '2024-12-01', '2024-12-30', 'all', 'RG');
```

### Search Service

```php
// Search stock or user
$results = $client->search()->search('BBCA');

// Search stock only
$stocks = $client->search()->searchStock('BCA', 'cursor');

// Search user only
$users = $client->search()->searchUser('username', 'cursor');
```

### Profile Service

```php
// Get user profile
$profile = $client->profile()->userDetails('username');

// Get user posts
$posts = $client->profile()->userPosts('username', '1', '10');

// Get user watchlist
$watchlist = $client->profile()->listWatchlist('username');
```

### Posts Service

```php
// Get all posts
$posts = $client->posts()->getPosts();

// Get posts by category
$posts = $client->posts()->getCategoryPosts('category');

// Get stock posts
$posts = $client->posts()->getStockPosts('BBCA');

// Get post detail
$post = $client->posts()->getPostById('post-id');
```

### Health Service

```php
// Check API status
$status = $client->health()->check();

// Check database status
$dbStatus = $client->health()->checkDatabase();

// Full check
$fullStatus = $client->health()->fullCheck();
```

## Error Handling

The SDK throws specific exceptions for different error scenarios:

```php
use Invezgo\Exception\ApiException;
use Invezgo\Exception\AuthenticationException;
use Invezgo\Exception\PaymentRequiredException;
use Invezgo\Exception\RateLimitException;

try {
    $stocks = $client->analysis()->getStockList();
} catch (AuthenticationException $e) {
    // API Key tidak valid atau tidak ditemukan (401)
    echo "Authentication failed: " . $e->getMessage();
} catch (PaymentRequiredException $e) {
    // Paket berlangganan tidak mencukupi atau API Key sudah expired (402)
    echo "Payment required: " . $e->getMessage();
} catch (RateLimitException $e) {
    // Melebihi batas permintaan API (429)
    echo "Rate limit exceeded: " . $e->getMessage();
} catch (ApiException $e) {
    // Other API errors
    echo "API Error: " . $e->getMessage();
}
```

## Laravel Integration

### Service Provider (Optional)

Create a service provider to bind the client:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Invezgo\InvezgoClient;

class InvezgoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(InvezgoClient::class, function ($app) {
            return new InvezgoClient(config('services.invezgo.api_key'));
        });
    }
}
```

Add to `config/services.php`:

```php
'invezgo' => [
    'api_key' => env('INVEZGO_API_KEY'),
],
```

Add to `.env`:

```
INVEZGO_API_KEY=your-api-key-here
```

### Usage in Laravel

```php
use Invezgo\InvezgoClient;

class StockController extends Controller
{
    public function index(InvezgoClient $client)
    {
        $stocks = $client->analysis()->getStockList();
        return view('stocks.index', compact('stocks'));
    }
}
```

## Available Services

- **AnalysisService** - Data Saham Indonesia (stocks, charts, financials, shareholders, etc.)
- **WatchlistsService** - Personal watchlist management
- **JournalsService** - Journal transaction management
- **PortfoliosService** - Portfolio management
- **AiService** - AI-powered analysis
- **SearchService** - Search stocks and users
- **ProfileService** - User profile operations
- **MembershipService** - Membership/subscription management
- **PostsService** - Posts and content
- **RecommendationService** - User recommendations
- **TradesService** - Realized trades management
- **ScreenerService** - Stock screener
- **HealthService** - API health checks

## Response Format

All methods return arrays containing the API response data. The structure depends on the specific endpoint. Please refer to the [Invezgo API Documentation](https://invezgo.com) for detailed response structures.

## Rate Limiting

The API has rate limits based on your subscription package. When rate limits are exceeded, a `RateLimitException` is thrown. You should implement retry logic with exponential backoff.

## Support

- **Website:** https://invezgo.com
- **Email:** admin@invezgo.com
- **API Documentation:** https://invezgo.com
- **API Key Settings:** https://invezgo.com/id/setting/api

## License

MIT License. See [LICENSE](LICENSE) file for details.

## Changelog

### 1.0.0
- Initial release
- Full API coverage
- All services implemented
- Exception handling
- Laravel integration support

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

