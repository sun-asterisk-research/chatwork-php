<?php

namespace SunAsterisk\Chatwork\Endpoints\Rooms;

class Files extends Endpoint
{
    /**
     * Get files in room. Maximum 100 files.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-files
     */
    public function list(array $options = []): array
    {
        return $this->api->get("rooms/{$this->roomId}/files", $options);
    }

    /**
     * Get file detail.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-files-file_id
     */
    public function detail(int $fileId, array $options = []): array
    {
        return $this->api->get("rooms/{$this->roomId}/files/{$fileId}", $options);
    }
}
