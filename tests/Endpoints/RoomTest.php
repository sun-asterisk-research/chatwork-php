<?php

use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Rooms;

class RoomTest extends TestCase
{
    protected $room_id = 100000;

    public function testGetMessage()
    {
        $response = $this->getMockResponse('rooms/getMessageResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')
            ->with("rooms/{$this->room_id}/messages", ['force' => 0])
            ->andReturn($response);

        $message = (new Rooms($api))->getMessage($this->room_id);
        $this->assertEquals($message, $response);
    }

    public function testSendMessage()
    {
        $body = "Hello!!";
        $response = $this->getMockResponse('rooms/sendMessageResponse');
        $data = [
            'body' => $body
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
            'body' => "[toall]\n" . $body
        ];
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('post')
            ->with("rooms/{$this->room_id}/messages", $data)
            ->andReturn($response);

        $message = (new Rooms($api))->sendMessageToAll($this->room_id, $body);
        $this->assertEquals($message, $response);
    }

    public function testMarkMessageAsReadWithNoMessageID()
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
                'message_id' => '123456'
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsRead($this->room_id, $message_id);
        $this->assertEquals($message, $response);

    }

    public function testMarkMessageAsUnRead(){
        $message_id = 123456;
        $response = $this->getMockResponse('rooms/markMessageAsUnReadResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with("rooms/{$this->room_id}/messages/unread", [
                'message_id' => '123456'
            ])
            ->andReturn($response);

        $message = (new Rooms($api))->markMessageAsUnRead($this->room_id, $message_id);
        $this->assertEquals($message, $response);
    }
}