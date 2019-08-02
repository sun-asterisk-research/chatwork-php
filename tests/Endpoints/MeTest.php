<?php

use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\Me;

class MeTest extends TestCase
{
    public function testMe()
    {
        $response = $this->getMockResponse('me');

        /** @var Chatwork $api */
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('me')->andReturns($response);

        $me = new Me($api);

        $this->assertEquals($response, $me());
    }
}
