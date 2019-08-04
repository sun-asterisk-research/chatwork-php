<?php

namespace SunAsterisk\Chatwork\Endpoints\Rooms;

class Messages extends Endpoint
{
    /**
     * Get room messages.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-messages
     */
    public function list(array $options = [])
    {
        return $this->api->get("rooms/{$this->roomId}/messages", $options);
    }

    /**
     * Create new message in room.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#POST-rooms-room_id-messages
     */
    public function create(string $body)
    {
        return $this->api->post("rooms/{$this->roomId}/messages", [
            'body' => $body,
        ]);
    }

    /**
     * Mark message as read.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id-messages-read
     */
    public function markAsRead(int $messageId)
    {
        return $this->api->put("rooms/{$this->roomId}/messages/read", [
            'message_id' => $messageId,
        ]);
    }

    /**
     * Mark message as unread.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id-messages-unread
     */
    public function markAsUnread(int $messageId)
    {
        return $this->api->put("rooms/{$this->roomId}/messages/unread", [
            'message_id' => $messageId,
        ]);
    }

    /**
     * Get message detail.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-messages-message_id
     */
    public function detail(int $messageId)
    {
        return $this->api->get("rooms/{$this->roomId}/messages/{$messageId}");
    }

    /**
     * Update a message/
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id-messages-message_id
     */
    public function update(int $messageId, string $body)
    {
        return $this->api->put("rooms/{$this->roomId}/messages/{$messageId}", [
            'body' => $body,
        ]);
    }

    /**
     * Delete a message.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#DELETE-rooms-room_id-messages-message_id
     */
    public function delete(int $messageId)
    {
        $this->api->delete("rooms/{$this->roomId}/messages/{$messageId}");
    }
}
