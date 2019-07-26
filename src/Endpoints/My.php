<?php


namespace SunAsterisk\Chatwork\Endpoints;

class My extends Endpoint
{
    public function status()
    {
        return $this->api->get('my/status');
    }

    public function tasks()
    {
        return $this->api->get('my/tasks');
    }
}
