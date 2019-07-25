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
}