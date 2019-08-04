<?php

namespace SunAsterisk\Chatwork\Endpoints;

class IncomingRequests extends Endpoint
{
    /**
     * Get pending contact requests
     *
     * @see http://developer.chatwork.com/vi/endpoint_incoming_requests.html#GET-incoming_requests
     *
     * @return array|null
     */
    public function list()
    {
        return $this->api->get('incoming_requests');
    }

    /**
     * Accept contact request
     *
     * @see http://developer.chatwork.com/vi/endpoint_incoming_requests.html#PUT-incoming_requests-request_id
     *
     * @param  int $requestId
     * @return array
     */
    public function accept($requestId)
    {
        return $this->api->put("incoming_requests/{$requestId}");
    }

    /**
     * Reject contact request
     *
     * @see http://developer.chatwork.com/vi/endpoint_incoming_requests.html#DELETE-incoming_requests-request_id
     *
     * @param  int $requestId
     * @return array
     */
    public function reject($requestId)
    {
        return $this->api->delete("incoming_requests/{$requestId}");
    }
}
