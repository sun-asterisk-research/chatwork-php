<?php

namespace SunAsterisk\Chatwork\Endpoints;

class Rooms extends Endpoint
{
    /**
     * Get user rooms list
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms
     */
    public function getRooms()
    {
        return $this->api->get('rooms');
    }

    /**
     * Create new room
     * @param  string $name
     * @param  array $membersAdminIds
     * @param  array $params
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#POST-rooms
     */
    public function createRoom($name, $membersAdminIds = [], $params = [])
    {
        $params['members_admin_ids'] = $membersAdminIds;
        $params['name'] = $name;

        $params['members_admin_ids'] = implode(',', $params['members_admin_ids']);
        if (!empty($params['members_member_ids'])) {
            $params['members_member_ids'] = implode(',', $params['members_member_ids']);
        }
        if (!empty($params['members_readonly_ids'])) {
            $params['members_readonly_ids'] = implode(',', $params['members_readonly_ids']);
        }

        return $this->api->post('rooms', $params);
    }

    /**
     * Get room information
     * @param  int $roomId
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id
     */
    public function getRoomById($roomId)
    {
        return $this->api->get('rooms/'.$roomId);
    }

    /**
     * Update room information
     * @param  int $roomId
     * @param  array $params
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id
     */
    public function updateRoomInfo($roomId, $params = [])
    {
        return $this->api->put('rooms/'.$roomId, $params);
    }

    /**
     * Leave/Delete Group chat
     * @param  int $roomId
     * @param  int $type
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#DELETE-rooms-room_id
     */
    public function deleteLeaveRoom($roomId, $type)
    {
        return $this->api->delete('rooms/' . $roomId, ['action_type' => $type]);
    }

    /**
     * Get all member of a room
     * @param  int $roomId
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-members
     */
    public function getRoomMembersById($roomId)
    {
        return $this->api->get(sprintf('rooms/%d/members', $roomId));
    }

    /**
     * Update room members
     * @param  int $roomId
     * @param  array $membersAdminIds
     * @param  array $params
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id-members
     */
    public function updateRoomMembers($roomId, $membersAdminIds = [], $params = [])
    {
        $params = array_merge(
            ['members_admin_ids' => $membersAdminIds,
            ], $params);
        if (!empty($params['members_admin_ids'])) {
            $params['members_admin_ids'] = implode(',', $params['members_admin_ids']);
        }
        if (!empty($params['members_member_ids'])) {
            $params['members_member_ids'] = implode(',', $params['members_member_ids']);
        }
        if (!empty($params['members_readonly_ids'])) {
            $params['members_readonly_ids'] = implode(',', $params['members_readonly_ids']);
        }

        return $this->api->put('rooms/'.$roomId, $params);
    }

    /**
     * Get file info endpoint
     * @param  int $roomId
     * @param  int $fileId
     * @param  bool $createDownloadUrl
     * @return array
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-files-file_id
     */
    public function getRoomFileById($roomId, $fileId, $createDownloadUrl = false)
    {
        return $this->api->get(
            sprintf('rooms/%d/files/%d', $roomId, $fileId),
            ['create_download_url' => $createDownloadUrl ? 1 : 0]
        );
    }

    /**
     * @param  int $roomId
     * @param  bool $force
     * @return array
     */
    public function getMessages($roomId, $force = false)
    {
        return $this->api->get("rooms/{$roomId}/messages", [
            'force' => $force ? 1 : 0,
        ]);
    }

    /**
     * @param  int $roomId
     * @param  string $body
     * @return array
     */
    public function sendMessage($roomId, $body)
    {
        return $this->api->post("rooms/{$roomId}/messages", [
            'body' => $body,
        ]);
    }

    /**
     * @param  int $roomId
     * @param  string $body
     * @return array
     */
    public function sendMessageToAll($roomId, $body)
    {
        $body = "[toall]\n" . $body;
        return $this->api->post("rooms/{$roomId}/messages", [
            'body' => $body,
        ]);
    }

    /**
     * @param  int $roomId
     * @param  int $messageId
     * @return array
     */
    public function markMessageAsRead($roomId, $messageId = null)
    {
        if ($messageId == null) {
            return $this->api->put("rooms/{$roomId}/messages/read");
        } else {
            return $this->api->put("rooms/{$roomId}/messages/read", [
                'message_id' => $messageId,
            ]);
        }
    }

    /**
     * @param  int $roomId
     * @param  int $messageId
     * @return array
     */
    public function markMessageAsUnRead($roomId, $messageId)
    {
        return $this->api->put("rooms/{$roomId}/messages/unread", [
            'message_id' => $messageId,
        ]);
    }

    /**
     * @param  int $roomId
     * @param  int $messageId
     * @param  string $body
     * @return array
     */
    public function updateMessage($roomId, $messageId, $body)
    {
        return $this->api->put("rooms/{$roomId}/messages/{$messageId}", [
            'body' => $body,
        ]);
    }

    /**
     * @param  int $roomId
     * @param  int $messageId
     * @return array
     */
    public function deleteMessage($roomId, $messageId)
    {
        return $this->api->delete("rooms/{$roomId}/messages/{$messageId}");
    }
}
