<?php

use SunAsterisk\Chatwork\Endpoints\My;

class MyTest extends TestCase
{
    protected $response;

    protected function setUp(): void
    {
        $this->response = $this->getMockResponse('my');
    }

    public function testStatus()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')
            ->with('my/status')
            ->andReturn($this->response['status']);

        $status = (new My($api))->status();
        $this->assertEquals($status, $this->response['status']);
    }

    public function testTasks()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')
            ->with('my/tasks')
            ->andReturn($this->response['tasks']);

        $task = (new My($api))->tasks();
        $this->assertEquals($task, $this->response['tasks']);
    }
}
