<?php

/**
 * Laravel Integration Example
 * 
 * This file shows how to use the SDK in a Laravel application
 */

// In your Laravel Controller

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Invezgo\InvezgoClient;
use Invezgo\Exception\ApiException;

class StockController extends Controller
{
    protected $invezgo;

    public function __construct(InvezgoClient $invezgo)
    {
        $this->invezgo = $invezgo;
    }

    /**
     * Display list of stocks
     */
    public function index()
    {
        try {
            $stocks = $this->invezgo->analysis()->getStockList();
            
            return view('stocks.index', [
                'stocks' => $stocks
            ]);
        } catch (ApiException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display stock detail
     */
    public function show($code)
    {
        try {
            $info = $this->invezgo->analysis()->information($code);
            $chart = $this->invezgo->analysis()->getAdvanceChart(
                $code,
                now()->subMonths(1)->format('Y-m-d'),
                now()->format('Y-m-d')
            );
            $shareholder = $this->invezgo->analysis()->shareholder($code);
            
            return view('stocks.show', [
                'info' => $info,
                'chart' => $chart,
                'shareholder' => $shareholder,
            ]);
        } catch (ApiException $e) {
            return redirect()->route('stocks.index')
                ->with('error', 'Failed to load stock data: ' . $e->getMessage());
        }
    }

    /**
     * Get top gainer/loser via AJAX
     */
    public function topChange()
    {
        try {
            $date = request()->get('date', date('Y-m-d'));
            $data = $this->invezgo->analysis()->topChange($date);
            
            return response()->json($data);
        } catch (ApiException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

// In routes/web.php
/*
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/{code}', [StockController::class, 'show'])->name('stocks.show');
Route::get('/api/top-change', [StockController::class, 'topChange']);
*/

// Service Provider Registration (app/Providers/InvezgoServiceProvider.php)
/*
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
*/

// config/services.php
/*
return [
    // ... other services
    
    'invezgo' => [
        'api_key' => env('INVEZGO_API_KEY'),
    ],
];
*/

// .env
/*
INVEZGO_API_KEY=your-api-key-here
*/

