<?php

use SunAsterisk\Chatwork\Auth\AccessToken;

class AccessTokenTest extends TestCase
{
    public function testGetHeaders()
    {
        $auth = new AccessToken("token");
        $headers = $auth->getHeaders();

        $this->assertArrayHasKey('Authorization', $headers);
        $this->assertEquals('Bearer token', $headers['Authorization']);
    }
}
