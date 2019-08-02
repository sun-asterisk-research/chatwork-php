<?php

namespace SunAsterisk\Chatwork\Endpoints\Rooms;

class Members extends Endpoint
{
    /**
     * Get room members.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-members
     */
    public function list(): array
    {
        return $this->api->get("rooms/{$this->roomId}/members");
    }

    /**
     * Update room members.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id-members
     */
    public function update(array $members): array
    {
        return $this->api->put("rooms/{$this->roomId}/members", [
            'members_admin_ids' => implode(',', $members['members_admin_ids'] ?? []),
            'members_member_ids' => implode(',', $members['members_member_ids'] ?? []),
            'members_readonly_ids' => implode(',', $members['members_readonly_ids'] ?? []),
        ]);
    }
}
