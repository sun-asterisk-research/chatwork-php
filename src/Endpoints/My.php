<?php


namespace SunAsterisk\Chatwork\Endpoints;

class My extends Endpoint
{
    /**
     * Get number of read/unread messages & uncompleted tasks.
     *
     * @see http://developer.chatwork.com/vi/endpoint_my.html#GET-my-status
     */
    public function status(): array
    {
        return $this->api->get('my/status');
    }

    /**
     * Get tasks list.
     *
     * http://developer.chatwork.com/vi/endpoint_my.html#GET-my-tasks
     */
    public function tasks(): array
    {
        return $this->api->get('my/tasks');
    }
}
