<?php


use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Rooms;

class RoomsTest extends TestCase
{
    protected $room_id = 100000;

    //GetMessage
    public function testGetMessageWithForceDefault()
    {
        $respone = $this->getMockResponse('rooms/messageGet');
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
        $respone = $this->getMockResponse('rooms/messageGet');
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
}
