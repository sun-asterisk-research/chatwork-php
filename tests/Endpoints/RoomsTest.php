<?php


use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Rooms;

class RoomsTest extends TestCase
{
    protected $room_id = 100000;

    //GetMessage
    public function testGetMessageWithForceDefault()
    {
        $respone = $this->getMockResponse('rooms/getMessageResponse');
        $params = [
            'force' => 0,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')->with("rooms/{$this->room_id}/messages", $params)
        ->andReturn($respone);

        $messagge = (new Rooms($api))->getMessages($this->room_id);
        $this->assertEquals($messagge, $respone);
    }

    public function testGetMessageWithForceTrue()
    {
        $respone = $this->getMockResponse('rooms/getMessageResponse');
        $params = [
            'force' => 1,
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')->with("rooms/{$this->room_id}/messages", $params)
            ->andReturn($respone);

        $messagge = (new Rooms($api))->getMessages($this->room_id, true);
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
            ->with("rooms/{$this->room_id}/messages", $data)
            ->andReturn($response);

        $message = (new Rooms($api))->sendMessage($this->room_id, $body);
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
            ->with("rooms/{$this->room_id}/messages", $data)
            ->andReturn($response);

        $message = (new Rooms($api))->sendMessageToAll($this->room_id, $body);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsReadWithoutMessageID()
    {
        $response = $this->getMockResponse('rooms/markMessageAsReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->room_id}/messages/read")
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsRead($this->room_id);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsReadWithMessageID()
    {
        $message_id = 123456;
        $response = $this->getMockResponse('rooms/markMessageAsReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->room_id}/messages/read", [
                'message_id' => '123456',
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsRead($this->room_id, $message_id);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsUnRead()
    {
        $message_id = 123456;
        $response = $this->getMockResponse('rooms/markMessageAsUnReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->room_id}/messages/unread", [
                'message_id' => '123456',
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsUnRead($this->room_id, $message_id);
        $this->assertEquals($message, $response);
    }

    public function testUpdateMessage()
    {
        $message_id = 123456;
        $body = "hello";
        $response = $this->getMockResponse('rooms/updateMessageResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->room_id}/messages/{$message_id}", [
                'body' => 'hello',
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->updateMessage($this->room_id, $message_id, $body);
        $this->assertEquals($message, $response);
    }
}
