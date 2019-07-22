<?php

namespace SunAsterisk\Chatwork\Endpoints;

use SunAsterisk\Chatwork\Chatwork;

abstract class Endpoint
{
    /** @var Chatwork */
    protected $api;

    public function __construct(Chatwork $api)
    {
        $this->api = $api;
    }
}
