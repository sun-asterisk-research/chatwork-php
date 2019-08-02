<?php

use SunAsterisk\Chatwork\Endpoints\Room;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use SunAsterisk\Chatwork\Endpoints\Rooms\Files;
use SunAsterisk\Chatwork\Endpoints\Rooms\Members;
use SunAsterisk\Chatwork\Endpoints\Rooms\Messages;
use SunAsterisk\Chatwork\Endpoints\Rooms\Tasks;

class RoomTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @dataProvider roomEndpoints
     */
    public function testGetRoomResourcesEndpoint($method, $endpointClassname)
    {
        $api = $this->getAPIMock();
        $room = new Room($api, 123);
        $endpoint = $room->$method();
        $this->assertInstanceOf($endpointClassname, $endpoint);
    }

    public function testGetRoomDetails()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')
            ->with('rooms/123')
            ->andReturn(['response']);

        $room = new Room($api, 123);
        $this->assertEquals(['response'], $room->detail());
    }

    public function testUpdateRoomMembers()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('put')
            ->with('rooms/123', [
                'description' => 'desc',
            ])->andReturn(['response']);

        $room = new Room($api, 123);
        $this->assertEquals(['response'], $room->updateRoomInfo([
            'description' => 'desc',
        ]));
    }

    public function testLeaveRoom()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('delete')
            ->with('rooms/123', ['action_type' => 'leave']);

        $room = new Room($api, 123);
        $room->leave();
    }

    public function testDeleteRoom()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('delete')
            ->with('rooms/123', ['action_type' => 'delete']);

        $room = new Room($api, 123);
        $room->delete();
    }

    public function roomEndpoints()
    {
        return [
            ['files', Files::class],
            ['members', Members::class],
            ['messages', Messages::class],
            ['tasks', Tasks::class],
        ];
    }
}
