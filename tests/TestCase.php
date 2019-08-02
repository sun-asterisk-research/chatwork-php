<?php

use Mockery as m;
use PHPUnit\Framework\TestCase as BaseTestCase;
use SunAsterisk\Chatwork\Chatwork;

class TestCase extends BaseTestCase
{
    /**
     * @return \Mockery\MockInterface
     */
    protected function getAPIMock()
    {
        $api = m::mock(Chatwork::class);

        return $api;
    }

    /**
     * @param  string $fixture
     * @return array
     */
    protected function getMockResponse($fixture)
    {
        return require __dir__."/Fixtures/{$fixture}.php";
    }
}
