<?php

namespace SunAsterisk\Chatwork\Endpoints;

class IncomingRequests extends Endpoint
{
    /**
     * Get Friend Request list
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_incoming_requests.html#GET-incoming_requests
     */
    public function getIncomingRequests()
    {
        return $this->api->get('incoming_requests');
    }

    /**
     * Accept contact request
     * @param  int $requestId
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_incoming_requests.html#PUT-incoming_requests-request_id
     */
    public function acceptContactRequest($requestId)
    {
        return $this->api->put(sprintf('incoming_requests/%d', $requestId));
    }

    /**
     * Reject contact request
     * @param  int $requestId
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_incoming_requests.html#DELETE-incoming_requests-request_id
     */
    public function rejectContactRequest($requestId)
    {
        return $this->api->delete(sprintf('incoming_requests/%d', $requestId));
    }
}
