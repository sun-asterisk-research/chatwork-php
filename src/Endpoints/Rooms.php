<?php

namespace SunAsterisk\Chatwork\Endpoints;

class Rooms extends Endpoint
{
    /**
     * Get user rooms list
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms
     */
    public function list()
    {
        return $this->api->get('rooms');
    }

    /**
     * Create new room
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#POST-rooms
     */
    public function create(array $params)
    {
        $room = array_merge($params, [
            'members_admin_ids' => implode(',', $params['members_admin_ids'] ?? []),
            'members_member_ids' => implode(',', $params['members_member_ids'] ?? []),
            'members_readonly_ids' => implode(',', $params['members_readonly_ids'] ?? []),
        ]);

        return $this->api->post('rooms', $room);
    }
}
