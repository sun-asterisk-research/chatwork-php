<?php

namespace SunAsterisk\Chatwork\Endpoints;

class Contacts extends Endpoint
{
    public function __invoke()
    {
        return $this->api->get('contacts');
    }
}
