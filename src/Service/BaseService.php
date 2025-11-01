<?php

namespace Invezgo\Service;

use Invezgo\InvezgoClient;

/**
 * Base service class
 */
abstract class BaseService implements ServiceInterface
{
    /**
     * @var InvezgoClient
     */
    protected InvezgoClient $client;

    /**
     * @param InvezgoClient $client
     */
    public function __construct(InvezgoClient $client)
    {
        $this->client = $client;
    }
}

