<?php

namespace SunAsterisk\Chatwork\Endpoints;

use SunAsterisk\Chatwork\Chatwork;

/**
 * @method \SunAsterisk\Chatwork\Endpoints\Rooms\Files files()
 * @method \SunAsterisk\Chatwork\Endpoints\Rooms\Members members()
 * @method \SunAsterisk\Chatwork\Endpoints\Rooms\Messages messages()
 * @method \SunAsterisk\Chatwork\Endpoints\Rooms\Tasks tasks()
 */
class Room extends Endpoint
{
    /**
     * @var int
     */
    protected $roomId;

    /**
     * @param int $roomId
     */
    public function __construct(Chatwork $api, int $roomId)
    {
        parent::__construct($api);
        $this->roomId = $roomId;
    }

    public function __call($name, $arguments)
    {
        $endpointClass = __NAMESPACE__.'\\Rooms\\'.ucfirst($name);

        return new $endpointClass($this->api, $this->roomId, ...$arguments);
    }

    /**
     * Get room information
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id
     */
    public function detail()
    {
        return $this->api->get("rooms/{$this->roomId}");
    }

    /**
     * Update room information
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#PUT-rooms-room_id
     */
    public function updateRoomInfo(array $params)
    {
        return $this->api->put("rooms/{$this->roomId}", $params);
    }

    /**
     * Delete Group chat
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#DELETE-rooms-room_id
     */
    public function delete()
    {
        $this->api->delete("rooms/{$this->roomId}", ['action_type' => 'delete']);
    }

    /**
     * Leave/Delete Group chat
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#DELETE-rooms-room_id
     */
    public function leave()
    {
        $this->api->delete("rooms/{$this->roomId}", ['action_type' => 'leave']);
    }
}
