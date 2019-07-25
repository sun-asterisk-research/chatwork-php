<?php


namespace SunAsterisk\Chatwork\Endpoints;


class Rooms extends Endpoint
{

    /**
     * @param $room_id
     * @param bool $force
     * @return array
     */
    public function getMessage($room_id, $force = false)
    {
        return $this->api->get("rooms/{$room_id}/messages", [
            'force' => $force ? 1 : 0
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
            'body' => $body
        ]);
    }

    /**
     * @param $room_id
     * @param $body
     * @return array
     */
    public function sendMessageToAll($room_id, $body)
    {
        $body = "[toall]\n" . $body;
        return $this->api->post("rooms/{$room_id}/messages", [
            'body' => $body
        ]);
    }

    public function markMessageAsRead($room_id, $message_id = null)
    {
        if ($message_id == null)
            return $this->api->put("rooms/{$room_id}/messages/read");
        else
            return $this->api->put("rooms/{$room_id}/messages/read", [
                'message_id' => $message_id
            ]);
    }

    public function markMessageAsUnRead($room_id, $message_id)
    {
        return $this->api->put("rooms/{$room_id}/messages/unread", [
            'message_id' => $message_id
        ]);
    }

}