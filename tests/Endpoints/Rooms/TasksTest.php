<?php

use SunAsterisk\Chatwork\Endpoints\Rooms\Tasks;

class TasksTest extends TestCase
{
    public function testGetTasksList()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/tasks', [
            'account_id' => 101,
        ])->andReturn(['response']);

        $tasks = new Tasks($api, 123);

        $this->assertEquals(['response'], $tasks->list([
            'account_id' => 101,
        ]));
    }

    public function testCreateTasK()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('post')->with('rooms/123/tasks', [
            'body' => 'Buy milk',
            'to_ids' => '101,102',
            'limit' => 1533081600,
        ])->andReturn(['response']);

        $tasks = new Tasks($api, 123);

        $this->assertEquals(['response'], $tasks->create(
            'Buy milk',
            [101, 102],
            new DateTime('2018-08-01 00:00:00'),
        ));
    }

    public function testGetTasksDetail()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/tasks/321', [
            'account_id' => 111,
        ])->andReturn(['response']);

        $tasks = new Tasks($api, 123);

        $this->assertEquals(['response'], $tasks->detail(321, [
            'account_id' => 111,
        ]));
    }
}
