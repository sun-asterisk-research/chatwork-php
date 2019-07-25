<?php

use Mockery as m;
use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Rooms;

class RoomsTest extends TestCase
{
    public function testGetRooms()
    {
        $response = $this->getMockResponse('rooms/getRooms');

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('get')->with('rooms')->andReturns($response);

        $rooms = new Rooms($api);

        $this->assertEquals($response, $rooms->getRooms());
    }

    public function testGetRoomById()
    {
        $responses = $this->getMockResponse('rooms/getRoomById');
        $roomId = $responses['roomId'];
        $response = $responses['roomInfo'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('get')->with(sprintf('rooms/%d', $roomId))->andReturns($response);

        $roomInfo = new Rooms($api);

        $this->assertEquals($response, $roomInfo->getRoomById($roomId));
    }

    public function testUpdateInfo()
    {
        $responses = $this->getMockResponse('rooms/updateRoomInfo');
        $roomId = $responses['roomId'];
        $params = $responses['params'];
        $response = $responses['updateRoom'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('put')->with('rooms/'.$roomId, $params)->andReturns($response);

        $updateRoom = new Rooms($api);

        $this->assertEquals($response, $updateRoom->updateRoomInfo($roomId, $params));
    }

    public function testDeleteLeaveRoom()
    {
        $responses = $this->getMockResponse('rooms/delete_leaveRoom');
        $roomId = $responses['roomId'];
        $type = $responses['type'];
        $response = $responses['deleteLeaveRoom'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('delete')->with('rooms/' . $roomId, ['action_type' => $type])->andReturns($response);

        $updateRoom = new Rooms($api);

        $this->assertEquals($response, $updateRoom->deleteLeaveRoom($roomId, $type));
    }

    public function testGetMembers()
    {
        $responses = $this->getMockResponse('rooms/getRoomMembers');
        $roomId = $responses['roomId'];
        $response = $responses['roomMembers'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('get')->with(sprintf('rooms/%d/members', $roomId))->andReturns($response);

        $roomInfo = new Rooms($api);

        $this->assertEquals($response, $roomInfo->getRoomMembersById($roomId));
    }
}
