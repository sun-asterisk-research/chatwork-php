<?php

namespace SunAsterisk\Chatwork\Endpoints;

class Me extends Endpoint
{
    public function __invoke()
    {
        return $this->api->get('me');
    }
}
