<?php

use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Rooms;

class RoomsTest extends TestCase
{
    public function testGetRooms()
    {
        $response = $this->getMockResponse('rooms/getRooms');

        /** @var Chatwork $api */
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms')->andReturns($response);

        $rooms = new Rooms($api);

        $this->assertEquals($response, $rooms->list());
    }

    public function testCreateRoom()
    {
        $response = [
            'room_ids' => [1234],
        ];

        /** @var Chatwork $api */
        $api = $this->getAPIMock();
        $api->shouldReceive('post')->with('rooms', [
            'name' => 'a room',
            'members_admin_ids' => '1,2,3',
            'members_member_ids' => '4,5',
            'members_readonly_ids' => '',
        ])->andReturns($response);

        $newRoom = new Rooms($api);
        $this->assertEquals($response, $newRoom->create([
            'name' => 'a room',
            'members_admin_ids' => [1, 2, 3],
            'members_member_ids' => [4, 5],
        ]));
    }
}
