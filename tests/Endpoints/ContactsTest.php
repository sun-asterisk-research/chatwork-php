<?php

use Mockery as m;

use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Contacts;

class StatusTest extends TestCase
{
    public function testMe()
    {
        $response = $this->getMockResponse('contacts');

        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('get')->with('contacts')->andReturns($response);
        $contacts = new Contacts($api);
        $this->assertEquals($response, $contacts());
    }
}
