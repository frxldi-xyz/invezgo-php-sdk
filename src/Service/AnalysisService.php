<?php

namespace Invezgo\Service;

/**
 * Analysis Service - Data Saham Indonesia
 */
class AnalysisService extends BaseService
{
    /**
     * Get list of all listed companies in BEI
     *
     * @return array
     */
    public function getStockList(): array
    {
        return $this->client->get('/analysis/list/stock');
    }

    /**
     * Get list of all brokers/securities in BEI
     *
     * @return array
     */
    public function getBrokerList(): array
    {
        return $this->client->get('/analysis/list/broker');
    }

    /**
     * Get complete company information
     *
     * @param string $code Stock code (4-6 characters)
     * @return array
     */
    public function information(string $code): array
    {
        return $this->client->get("/analysis/information/{$code}");
    }

    /**
     * Get top gainer & loser daily
     *
     * @param string $date Date in YYYY-MM-DD format (use working day for best results)
     * @return array
     */
    public function topChange(string $date): array
    {
        return $this->client->get('/analysis/top/change', ['date' => $date]);
    }

    /**
     * Get top foreign accumulation & distribution
     *
     * @param string $date Date in YYYY-MM-DD format (use working day for best results)
     * @return array
     */
    public function topForeign(string $date): array
    {
        return $this->client->get('/analysis/top/foreign', ['date' => $date]);
    }

    /**
     * Get top bandarmologi accumulation & distribution
     *
     * @param string $date Date in YYYY-MM-DD format (use working day for best results)
     * @return array
     */
    public function topAccumulation(string $date): array
    {
        return $this->client->get('/analysis/top/accumulation', ['date' => $date]);
    }

    /**
     * Get intraday chart data
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $market Market type: RG (Reguler), NG (Negotiated), TN (Tunai). Default: RG
     * @return array
     */
    public function getIntradayChart(string $code, string $market = 'RG'): array
    {
        return $this->client->get("/analysis/intraday/{$code}", ['market' => $market]);
    }

    /**
     * Get order book data
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $market Market type: RG (Reguler), NG (Negotiated), TN (Tunai)
     * @return array
     */
    public function getOrderBook(string $code, string $market): array
    {
        return $this->client->get("/analysis/order-book/{$code}", ['market' => $market]);
    }

    /**
     * Get complete stock price chart
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @return array
     */
    public function getAdvanceChart(string $code, string $from, string $to): array
    {
        return $this->client->get("/analysis/chart/stock/{$code}", [
            'from' => $from,
            'to' => $to,
        ]);
    }

    /**
     * Get indicator chart data
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $indicator Indicator type (bdm, rsi, macd, dll)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @return array
     */
    public function getIndicatorChart(string $code, string $indicator, string $from, string $to): array
    {
        return $this->client->get("/analysis/chart/stock/{$indicator}/{$code}", [
            'from' => $from,
            'to' => $to,
        ]);
    }

    /**
     * Get shareholder detail data
     *
     * @param string $code Stock code (4-6 characters)
     * @return array
     */
    public function shareholderDetail(string $code): array
    {
        return $this->client->get("/analysis/shareholder-detail/{$code}");
    }

    /**
     * Get shareholder number
     *
     * @param string $code Stock code (4-6 characters)
     * @return array
     */
    public function shareholderNumber(string $code): array
    {
        return $this->client->get("/analysis/shareholder/number/{$code}");
    }

    /**
     * Get shareholder composition
     *
     * @param string $code Stock code (4-6 characters)
     * @return array
     */
    public function shareholder(string $code): array
    {
        return $this->client->get("/analysis/shareholder/{$code}");
    }

    /**
     * Get KSEI shareholder data
     *
     * @param string $code Stock code (4-6 characters)
     * @param int $range Number of months (max 12)
     * @return array
     */
    public function shareholderKSEI(string $code, int $range = 6): array
    {
        return $this->client->get("/analysis/shareholder/ksei/{$code}", ['range' => $range]);
    }

    /**
     * Get broker summary per stock
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param string $investor Investor type: all, f (foreign), d (domestic)
     * @param string $market Market type: RG (Reguler), NG (Negotiated), TN (Tunai)
     * @return array
     */
    public function summaryStock(string $code, string $from, string $to, string $investor = 'all', string $market = 'RG'): array
    {
        return $this->client->get("/analysis/summary/stock/{$code}", [
            'from' => $from,
            'to' => $to,
            'investor' => $investor,
            'market' => $market,
        ]);
    }

    /**
     * Get broker summary per broker
     *
     * @param string $code Broker code (2 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param string $investor Investor type: all, f (foreign), d (domestic)
     * @param string $market Market type: RG (Reguler), NG (Negotiated), TN (Tunai)
     * @return array
     */
    public function summaryBroker(string $code, string $from, string $to, string $investor = 'all', string $market = 'RG'): array
    {
        return $this->client->get("/analysis/summary/broker/{$code}", [
            'from' => $from,
            'to' => $to,
            'investor' => $investor,
            'market' => $market,
        ]);
    }

    /**
     * Get broker summary chart for stock
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param string $scope Calculation component: volume, value, freq
     * @param string $market Market type: RG (Reguler), NG (Negotiated), TN (Tunai)
     * @return array
     */
    public function summaryStockChart(string $code, string $from, string $to, string $scope, string $market = 'RG'): array
    {
        return $this->client->get("/analysis/summary-chart/stock/{$code}", [
            'from' => $from,
            'to' => $to,
            'scope' => $scope,
            'market' => $market,
        ]);
    }

    /**
     * Get broker summary chart for broker
     *
     * @param string $code Broker code (2 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param string $scope Calculation component: volume, value, freq
     * @param string $market Market type: RG (Reguler), NG (Negotiated), TN (Tunai)
     * @return array
     */
    public function summaryBrokerChart(string $code, string $from, string $to, string $scope, string $market = 'RG'): array
    {
        return $this->client->get("/analysis/summary-chart/broker/{$code}", [
            'from' => $from,
            'to' => $to,
            'scope' => $scope,
            'market' => $market,
        ]);
    }

    /**
     * Get inventory chart for stock
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param string $scope Calculation component: vol, val, freq
     * @param string $investor Investor type: all, f (foreign), d (domestic)
     * @param int $limit Number of brokers to display (max 20)
     * @param string $market Market type: ALL, RG (Reguler), NG (Negotiated), TN (Tunai)
     * @param array|null $filter Broker codes to filter (comma separated)
     * @return array
     */
    public function inventoryStockChart(
        string $code,
        string $from,
        string $to,
        string $scope,
        string $investor = 'all',
        int $limit = 5,
        string $market = 'RG',
        ?array $filter = null
    ): array {
        $params = [
            'from' => $from,
            'to' => $to,
            'scope' => $scope,
            'investor' => $investor,
            'limit' => $limit,
            'market' => $market,
        ];

        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->client->get("/analysis/inventory-chart/stock/{$code}", $params);
    }

    /**
     * Get inventory chart for broker
     *
     * @param string $code Broker code (2 characters)
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param string $scope Calculation component: vol, val, freq
     * @param string $investor Investor type: all, f (foreign), d (domestic)
     * @param int $limit Number of stocks to display (max 20)
     * @param string $market Market type: ALL, RG (Reguler), NG (Negotiated), TN (Tunai)
     * @param array|null $filter Stock codes to filter (comma separated)
     * @return array
     */
    public function inventoryBrokerChart(
        string $code,
        string $from,
        string $to,
        string $scope,
        string $investor = 'all',
        int $limit = 5,
        string $market = 'RG',
        ?array $filter = null
    ): array {
        $params = [
            'from' => $from,
            'to' => $to,
            'scope' => $scope,
            'investor' => $investor,
            'limit' => $limit,
            'market' => $market,
        ];

        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->client->get("/analysis/inventory-chart/broker/{$code}", $params);
    }

    /**
     * Get momentum chart
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $date Date in YYYY-MM-DD format (use working day for best results)
     * @param int $range Time interval in minutes (5, 10, 15, 30, 60)
     * @param string $scope Calculation component: vol, val, freq
     * @return array
     */
    public function momentumChart(string $code, string $date, int $range, string $scope): array
    {
        return $this->client->get("/analysis/momentum-chart/{$code}", [
            'date' => $date,
            'range' => $range,
            'scope' => $scope,
        ]);
    }

    /**
     * Get intraday inventory chart
     *
     * @param string $code Stock code (4-6 characters)
     * @param int $range Time interval in minutes (5, 10, 15, 30, 60)
     * @param string $type Inventory chart type
     * @param int $total Total number of data to display
     * @param string $buyer Filter buyer broker (comma separated)
     * @param string $seller Filter seller broker (comma separated)
     * @param string $market Market type: ALL, RG (Reguler), NG (Negotiated), TN (Tunai)
     * @param string|null $broker Broker code to filter (comma separated)
     * @return array
     */
    public function intradayInventoryChart(
        string $code,
        int $range,
        string $type,
        int $total,
        string $buyer,
        string $seller,
        string $market = 'RG',
        ?string $broker = null
    ): array {
        $params = [
            'range' => $range,
            'type' => $type,
            'total' => $total,
            'buyer' => $buyer,
            'seller' => $seller,
            'market' => $market,
        ];

        if ($broker !== null) {
            $params['broker'] = $broker;
        }

        return $this->client->get("/analysis/intraday-inventory-chart/{$code}", $params);
    }

    /**
     * Get sankey chart (crossing)
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $type Crossing analysis type
     * @param string $market Market type: ALL, RG (Reguler), NG (Negotiated), TN (Tunai)
     * @param string|null $buyer Filter buyer broker (comma separated)
     * @param string|null $seller Filter seller broker (comma separated)
     * @return array
     */
    public function sankeyChart(string $code, string $type, string $market = 'RG', ?string $buyer = null, ?string $seller = null): array
    {
        $params = ['type' => $type, 'market' => $market];

        if ($buyer !== null) {
            $params['buyer'] = $buyer;
        }

        if ($seller !== null) {
            $params['seller'] = $seller;
        }

        return $this->client->get("/analysis/sankey-chart/{$code}", $params);
    }

    /**
     * Get price table
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $date Date in YYYY-MM-DD format (use working day for best results)
     * @return array
     */
    public function priceTable(string $code, string $date): array
    {
        return $this->client->get("/analysis/price-table/{$code}", ['date' => $date]);
    }

    /**
     * Get time table
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $date Date in YYYY-MM-DD format (use working day for best results)
     * @param int $range Time interval in minutes (5, 10, 15, 30, 60)
     * @return array
     */
    public function timeTable(string $code, string $date, int $range): array
    {
        return $this->client->get("/analysis/time-table/{$code}", [
            'date' => $date,
            'range' => $range,
        ]);
    }

    /**
     * Get price diary (daily price changes)
     *
     * @param string $code Stock code (4-6 characters)
     * @return array
     */
    public function priceDiary(string $code): array
    {
        return $this->client->get("/analysis/price-diary/{$code}");
    }

    /**
     * Get price seasonality (monthly price changes)
     *
     * @param string $code Stock code (4-6 characters)
     * @param int $range Number of months (max 60)
     * @return array
     */
    public function priceSeasonality(string $code, int $range = 12): array
    {
        return $this->client->get("/analysis/price-seasonality/{$code}", ['range' => $range]);
    }

    /**
     * Get shareholder above 5%
     *
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param int $limit Number of data per page (max 100)
     * @param int $page Page number (starts from 1)
     * @param string|null $name Shareholder name filter
     * @param array|null $broker Broker codes filter
     * @param string|null $code Stock code filter
     * @return array
     */
    public function shareholderAbove(
        string $from,
        string $to,
        int $limit = 10,
        int $page = 1,
        ?string $name = null,
        ?array $broker = null,
        ?string $code = null
    ): array {
        $params = [
            'from' => $from,
            'to' => $to,
            'limit' => $limit,
            'page' => $page,
        ];

        if ($name !== null) {
            $params['name'] = $name;
        }

        if ($broker !== null) {
            $params['broker'] = $broker;
        }

        if ($code !== null) {
            $params['code'] = $code;
        }

        return $this->client->get('/analysis/shareholder-above', $params);
    }

    /**
     * Get shareholder above 5% chart
     *
     * @param string $code Stock code
     * @param string $broker Broker code
     * @param string $name Shareholder name
     * @param string $date Date
     * @return array
     */
    public function shareholderAboveChart(string $code, string $broker, string $name, string $date): array
    {
        return $this->client->get("/analysis/shareholder-above-chart/{$code}", [
            'broker' => $broker,
            'name' => $name,
            'date' => $date,
        ]);
    }

    /**
     * Get insider trading data
     *
     * @param string $from Start date (YYYY-MM-DD format)
     * @param string $to End date (YYYY-MM-DD format)
     * @param int $limit Number of data per page (max 100)
     * @param int $page Page number (starts from 1)
     * @param string|null $name Shareholder name filter
     * @param string|null $code Stock code filter
     * @return array
     */
    public function insider(
        string $from,
        string $to,
        int $limit = 10,
        int $page = 1,
        ?string $name = null,
        ?string $code = null
    ): array {
        $params = [
            'from' => $from,
            'to' => $to,
            'limit' => $limit,
            'page' => $page,
        ];

        if ($name !== null) {
            $params['name'] = $name;
        }

        if ($code !== null) {
            $params['code'] = $code;
        }

        return $this->client->get('/analysis/shareholder-insider', $params);
    }

    /**
     * Get insider chart
     *
     * @param string $code Stock code
     * @param string $name Shareholder name
     * @param string $date Date
     * @return array
     */
    public function insiderChart(string $code, string $name, string $date): array
    {
        return $this->client->get("/analysis/insider-chart/{$code}", [
            'name' => $name,
            'date' => $date,
        ]);
    }

    /**
     * Get financial statement
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $statement Statement type: BS (Neraca), IS (Laba Rugi), CF (Arus Kas)
     * @param string $type Period type: FY (Tahunan), Q (Kuartalan), Q1-Q4 (Kuartal spesifik)
     * @param int $limit Number of periods (max 20)
     * @return array
     */
    public function financialStatement(string $code, string $statement, string $type, int $limit = 10): array
    {
        return $this->client->get("/analysis/financial-statement/{$code}", [
            'statement' => $statement,
            'type' => $type,
            'limit' => $limit,
        ]);
    }

    /**
     * Get financial statement chart
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $statement Statement type: BS (Neraca), IS (Laba Rugi), CF (Arus Kas)
     * @param string $type Period type: FY (Tahunan), Q (Kuartalan), Q1-Q4 (Kuartal spesifik)
     * @param string $limit Number of periods (max 20)
     * @param string $account Account ID to visualize
     * @return array
     */
    public function financialStatementChart(string $code, string $statement, string $type, string $limit, string $account): array
    {
        return $this->client->get("/analysis/financial-statement-chart/{$code}", [
            'statement' => $statement,
            'type' => $type,
            'limit' => $limit,
            'account' => $account,
        ]);
    }

    /**
     * Get key statistics
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $type Period type: FY (Tahunan), Q (Kuartalan), Q1-Q4 (Kuartal spesifik)
     * @param int $limit Number of periods (max 20)
     * @return array
     */
    public function keystat(string $code, string $type, int $limit = 10): array
    {
        return $this->client->get("/analysis/keystat/{$code}", [
            'type' => $type,
            'limit' => $limit,
        ]);
    }

    /**
     * Get key statistics chart
     *
     * @param string $code Stock code (4-6 characters)
     * @param string $type Period type: FY (Tahunan), Q (Kuartalan), Q1-Q4 (Kuartal spesifik)
     * @param string $limit Number of periods
     * @param string $name Metric name to visualize
     * @return array
     */
    public function keystatChart(string $code, string $type, string $limit, string $name): array
    {
        return $this->client->get("/analysis/keystat-chart/{$code}", [
            'type' => $type,
            'limit' => $limit,
            'name' => $name,
        ]);
    }
}

