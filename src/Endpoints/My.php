<?php


namespace SunAsterisk\Chatwork\Endpoints;

class My extends Endpoint
{
    /**
     * @return array
     */
    public function status()
    {
        return $this->api->get('my/status');
    }

    /**
     * @return array
     */
    public function tasks()
    {
        return $this->api->get('my/tasks');
    }
}
