<?php


use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\My;

class MyTest extends TestCase
{
    protected $response;

    protected function setUp() : void
    {
        $this->response = $this->getMockResponse('my');
    }

    public function testStatus()
    {

        $api = Mockery::mock(ChatWork::class);
        $api->shouldReceive('get')
            ->with('my/status')
            ->andReturn($this->response['status']);

        $status = (new My($api))->status();
        $this->assertEquals($status, $this->response['status']);
    }

}