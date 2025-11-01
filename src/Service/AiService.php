<?php

namespace Invezgo\Service;

/**
 * AI Service - AI Chat
 */
class AiService extends BaseService
{
    /**
     * AI analysis for KSEI shareholder
     *
     * @param string $code Stock code
     * @return array
     */
    public function shareholderKSEI(string $code): array
    {
        return $this->client->get("/ai/shareholder/ksei/{$code}");
    }

    /**
     * AI analysis for inventory chart stock
     *
     * @param string $code Stock code
     * @param string $from Start date
     * @param string $to End date
     * @param string $scope Scope
     * @param string $investor Investor type
     * @param string $limit Limit
     * @param string $market Market type
     * @param string $filter Filter
     * @return array
     */
    public function inventoryStockChart(
        string $code,
        string $from,
        string $to,
        string $scope,
        string $investor,
        string $limit,
        string $market,
        string $filter
    ): array {
        return $this->client->get("/ai/inventory-chart/stock/{$code}", [
            'from' => $from,
            'to' => $to,
            'scope' => $scope,
            'investor' => $investor,
            'limit' => $limit,
            'market' => $market,
            'filter' => $filter,
        ]);
    }

    /**
     * AI analysis for news
     *
     * @param string $code Stock code
     * @return array
     */
    public function news(string $code): array
    {
        return $this->client->get("/ai/news/{$code}");
    }

    /**
     * AI analysis for broker summary
     *
     * @param string $code Stock code
     * @param string $from Start date
     * @param string $to End date
     * @param string $investor Investor type
     * @param string $market Market type
     * @return array
     */
    public function brokerSummary(string $code, string $from, string $to, string $investor, string $market): array
    {
        return $this->client->get("/ai/summary/stock/{$code}", [
            'from' => $from,
            'to' => $to,
            'investor' => $investor,
            'market' => $market,
        ]);
    }

    /**
     * AI analysis for insider shareholder
     *
     * @param string $code Stock code
     * @param string $name Shareholder name
     * @param string $from Start date
     * @param string $to End date
     * @param string $page Page number
     * @param string $limit Limit
     * @return array
     */
    public function insider(string $code, string $name, string $from, string $to, string $page, string $limit): array
    {
        return $this->client->get('/ai/shareholder-insider', [
            'code' => $code,
            'name' => $name,
            'from' => $from,
            'to' => $to,
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * AI analysis for shareholder above 5%
     *
     * @param string $code Stock code
     * @param string $broker Broker code
     * @param string $name Shareholder name
     * @param string $from Start date
     * @param string $to End date
     * @param string $page Page number
     * @param string $limit Limit
     * @return array
     */
    public function shareholderAbove(
        string $code,
        string $broker,
        string $name,
        string $from,
        string $to,
        string $page,
        string $limit
    ): array {
        return $this->client->get('/ai/shareholder-above', [
            'code' => $code,
            'broker' => $broker,
            'name' => $name,
            'from' => $from,
            'to' => $to,
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * AI analysis for intraday inventory
     *
     * @param string $code Stock code
     * @param int $range Range
     * @param string $type Type
     * @param int $total Total
     * @param string $buyer Buyer
     * @param string $seller Seller
     * @param string $broker Broker
     * @param string $market Market type
     * @return array
     */
    public function intradayInventory(
        string $code,
        int $range,
        string $type,
        int $total,
        string $buyer,
        string $seller,
        string $broker,
        string $market
    ): array {
        return $this->client->get("/ai/intraday-inventory-chart/{$code}", [
            'range' => $range,
            'type' => $type,
            'total' => $total,
            'buyer' => $buyer,
            'seller' => $seller,
            'broker' => $broker,
            'market' => $market,
        ]);
    }

    /**
     * AI analysis for sankey chart
     *
     * @param string $code Stock code
     * @param string $type Type
     * @param string $buyer Buyer
     * @param string $seller Seller
     * @param string $market Market type
     * @return array
     */
    public function sankeyChart(string $code, string $type, string $buyer, string $seller, string $market): array
    {
        return $this->client->get("/ai/sankey-chart/{$code}", [
            'type' => $type,
            'buyer' => $buyer,
            'seller' => $seller,
            'market' => $market,
        ]);
    }

    /**
     * AI analysis for shareholder table
     *
     * @param string $code Stock code
     * @return array
     */
    public function shareholderTable(string $code): array
    {
        return $this->client->get("/ai/shareholder/{$code}");
    }

    /**
     * AI analysis for financial statement
     *
     * @param string $code Stock code
     * @param string $statement Statement type
     * @param string $type Period type
     * @param string $limit Limit
     * @return array
     */
    public function financialStatement(string $code, string $statement, string $type, string $limit): array
    {
        return $this->client->get("/ai/financial-statement/{$code}", [
            'statement' => $statement,
            'type' => $type,
            'limit' => $limit,
        ]);
    }

    /**
     * AI analysis for key statistics
     *
     * @param string $code Stock code
     * @param string $type Period type
     * @param string $limit Limit
     * @return array
     */
    public function keystat(string $code, string $type, string $limit): array
    {
        return $this->client->get("/ai/keystat/{$code}", [
            'type' => $type,
            'limit' => $limit,
        ]);
    }
}

