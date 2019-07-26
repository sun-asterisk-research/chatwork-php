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

    public function testCreatRoom()
    {
        $responses = $this->getMockResponse('rooms/createRoom');
        $name = $responses['name'];
        $params = $responses['params'];
        $membersAdminIds = $responses['membersAdminIds'];
        $params1 = $responses['params1'];
        $response = $responses['newRoom'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('post')->with('rooms', $params1)->andReturns($response);

        $newRoom = new Rooms($api);
        $this->assertEquals($response, $newRoom->createRoom($name, $membersAdminIds, $params));
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

    public function testUpdateRoomMembers()
    {
        $responses = $this->getMockResponse('rooms/updateRoomMembers');
        $roomId = $responses['roomId'];
        $params = $responses['params'];
        $membersAdminIds = $responses['membersAdminIds'];
        $params1 = $responses['params1'];
        $response = $responses['update'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('put')->with('rooms/'.$roomId, $params1)->andReturns($response);

        $updateRoom = new Rooms($api);
        $this->assertEquals($response, $updateRoom->updateRoomMembers($roomId, $membersAdminIds, $params));
    }

    public function testGetRoomFileById()
    {
        $responses = $this->getMockResponse('rooms/getRoomFileById');
        $room_id = $responses['roomId'];
        $file_id = $responses['fileId'];
        $response = $responses['fileInfo'];

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('get')
            ->with(sprintf('rooms/%d/files/%d', $room_id, $file_id), ['create_download_url' => 0])
            ->andReturns($response);

        $roomInfo = new Rooms($api);

        $this->assertEquals($response, $roomInfo->getRoomFileById($room_id, $file_id));
    }

    protected $roomId = 100000;

    //GetMessage
    public function testGetMessageWithForceDefault()
    {
        $respone = $this->getMockResponse('rooms/messageGet');
        $params = [
            'force' => 0,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')->with("rooms/{$this->roomId}/messages", $params)
        ->andReturn($respone);

        $messagge = (new Rooms($api))->getMessages($this->roomId);
        $this->assertEquals($messagge, $respone);
    }

    public function testGetMessageWithForceTrue()
    {
        $respone = $this->getMockResponse('rooms/messageGet');
        $params = [
            'force' => 1,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')->with("rooms/{$this->roomId}/messages", $params)
            ->andReturn($respone);

        $messagge = (new Rooms($api))->getMessages($this->roomId, true);
        $this->assertEquals($messagge, $respone);
    }
}
