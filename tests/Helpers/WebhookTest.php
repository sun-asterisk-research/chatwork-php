<?php

use PHPUnit\Framework\TestCase;
use SunAsterisk\Chatwork\Helpers\Webhook;

class WebhookTest extends TestCase
{
    /**
     * @dataProvider verifySignatureTestCases
     */
    public function testVerifySignature($requestBody, $signature, $valid)
    {
        $token = 'sz6o4tXnI0nm0KBdqHOeCJc6ekI=';

        $this->assertEquals($valid, Webhook::verifySignature($token, $requestBody, $signature));
    }

    public function verifySignatureTestCases()
    {
        return [
            ['test', 'rgvtfnFpqHHbwJB9dJ3Gl8YyjT8kW0w9CpMjpzjnUO4=', true],
            ['whatever', 'whatever', false],
        ];
    }
}
