<?php

use SunAsterisk\Chatwork\Exceptions\APIException;

class APIExceptionTest extends TestCase
{
    public function testGetStatus()
    {
        $e = new APIException(400, [
            'errors' => [
                'The message is not found',
            ],
        ]);

        $this->assertEquals(400, $e->getStatus());
    }

    public function testGetMessage()
    {
        $e = new APIException(400, [
            'errors' => [
                'The message is not found',
            ],
        ]);

        $this->assertEquals('The message is not found', $e->getMessage());
    }

    public function testGetResponse()
    {
        $response = [
            'errors' => [
                'The message is not found',
            ],
        ];

        $e = new APIException(400, $response);

        $this->assertEquals($response, $e->getResponse());
    }
}
