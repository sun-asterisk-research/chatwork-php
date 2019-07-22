<?php

use SunAsterisk\Chatwork\Auth\APIToken;

class APITokenTest extends TestCase
{
    public function testGetHeaders()
    {
        $auth = new APIToken("token");
        $headers = $auth->getHeaders();

        $this->assertArrayHasKey('X-ChatworkToken', $headers);
        $this->assertEquals('token', $headers['X-ChatworkToken']);
    }
}
