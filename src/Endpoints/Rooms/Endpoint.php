<?php

namespace SunAsterisk\Chatwork\Endpoints\Rooms;

use SunAsterisk\Chatwork\Chatwork;

class Endpoint
{
    /**
     * @var Chatwork
     */
    protected $api;

    /**
     * @var int
     */
    protected $roomId;

    public function __construct(Chatwork $api, int $roomId)
    {
        $this->api = $api;
        $this->roomId = $roomId;
    }
}
