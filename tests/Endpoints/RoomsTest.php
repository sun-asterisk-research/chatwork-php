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
        $respone = $this->getMockResponse('rooms/getMessageResponse');
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
        $respone = $this->getMockResponse('rooms/getMessageResponse');
        $params = [
            'force' => 1,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')->with("rooms/{$this->roomId}/messages", $params)
            ->andReturn($respone);

        $messagge = (new Rooms($api))->getMessages($this->roomId, true);
        $this->assertEquals($messagge, $respone);
    }

    public function testSendMessage()
    {
        $body = "Hello!!";
        $response = $this->getMockResponse('rooms/sendMessageResponse');
        $data = [
            'body' => $body,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('post')
            ->with("rooms/{$this->roomId}/messages", $data)
            ->andReturn($response);

        $message = (new Rooms($api))->sendMessage($this->roomId, $body);
        $this->assertEquals($message, $response);
    }

    public function testSendMessageToAll()
    {
        $body = "Hello!!";
        $response = $this->getMockResponse('rooms/sendMessageResponse');
        $data = [
            'body' => "[toall]\n" . $body,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('post')
            ->with("rooms/{$this->roomId}/messages", $data)
            ->andReturn($response);

        $message = (new Rooms($api))->sendMessageToAll($this->roomId, $body);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsReadWithoutMessageID()
    {
        $response = $this->getMockResponse('rooms/markMessageAsReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->roomId}/messages/read")
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsRead($this->roomId);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsReadWithMessageID()
    {
        $messageId = 123456;
        $response = $this->getMockResponse('rooms/markMessageAsReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->roomId}/messages/read", [
                'message_id' => '123456',
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsRead($this->roomId, $messageId);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsUnRead()
    {
        $messageId = 123456;
        $response = $this->getMockResponse('rooms/markMessageAsUnReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->roomId}/messages/unread", [
                'message_id' => '123456',
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsUnRead($this->roomId, $messageId);
        $this->assertEquals($message, $response);
    }

    public function testUpdateMessage()
    {
        $messageId = 123456;
        $body = "hello";
        $response = $this->getMockResponse('rooms/updateMessageResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->roomId}/messages/{$messageId}", [
                'body' => 'hello',
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->updateMessage($this->roomId, $messageId, $body);
        $this->assertEquals($message, $response);
    }

    public function testDeleteMessage()
    {
        $messageId = 123456;
        $response = $this->getMockResponse('rooms/deleteMessageResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('delete')
            ->with("rooms/{$this->roomId}/messages/{$messageId}")
            ->andReturn($response);

        $message = (new Rooms($api))->deleteMessage($this->roomId, $messageId);
        $this->assertEquals($message, $response);
    }

    public function testGetFileWithoutAccountID()
    {
        $response = $this->getMockResponse('rooms/getFileResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')
            ->with("rooms/{$this->roomId}/files")
            ->andReturn($response);

        $task = (new Rooms($api))->getFiles($this->roomId);
        $this->assertEquals($task, $response);
    }

    public function testGetFileWithAccountID()
    {
        $accountId = 123;
        $response = $this->getMockResponse('rooms/getFileResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')
            ->with("rooms/{$this->roomId}/files", [
                'account_id' => $accountId,
            ])
            ->andReturn($response);

        $task = (new Rooms($api))->getFiles($this->roomId, $accountId);
        $this->assertEquals($task, $response);
    }
}
