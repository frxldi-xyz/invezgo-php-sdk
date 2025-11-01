<?php

namespace Invezgo\Service;

use Invezgo\InvezgoClient;

/**
 * Base service interface
 */
interface ServiceInterface
{
    /**
     * @param InvezgoClient $client
     */
    public function __construct(InvezgoClient $client);
}

