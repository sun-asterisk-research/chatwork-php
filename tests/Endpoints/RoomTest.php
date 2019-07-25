<?php
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Rooms;

class RoomTest extends TestCase
{
    protected $room_id = 100000;
    public function testGetMessage(){
        $response = $this->getMockResponse('rooms/getMessageResponse');
        $api = Mockery::mock(Chatwork::class);
        $api->shouldReceive('get')
            ->with("rooms/{$this->room_id}/messages", ['force' => 0])
            ->andReturn($response);

        $message = (new Rooms($api))->getMessage($this->room_id);
        $this->assertEquals($message, $response);
    }
}