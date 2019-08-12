<?php

use SunAsterisk\Chatwork\Endpoints\Contacts;

class ContactsTest extends TestCase
{
    public function testMe()
    {
        $response = $this->getMockResponse('contacts');

        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('contacts')->andReturns($response);
        $contacts = new Contacts($api);
        $this->assertEquals($response, $contacts());
    }
}
