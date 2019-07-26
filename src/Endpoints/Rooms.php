<?php


namespace SunAsterisk\Chatwork\Endpoints;

class Rooms extends Endpoint
{

    /**
     * @param $room_id
     * @param bool $force
     * @return array
     */
    public function getMessages($room_id, $force = false)
    {
        return $this->api->get("rooms/{$room_id}/messages", [
            'force' => $force ? 1 : 0,
        ]);
    }

    /**
     * @param $room_id
     * @param $body
     * @return array
     */
    public function sendMessage($room_id, $body)
    {
        return $this->api->post("rooms/{$room_id}/messages", [
            'body' => $body,
        ]);
    }
}
