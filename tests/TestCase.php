<?php

use Mockery as m;
use PHPUnit\Framework\TestCase as BaseTestCase;
use SunAsterisk\Chatwork\Chatwork;

class TestCase extends BaseTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        m::close();
    }

    /**
     * @return \Mockery\MockInterface
     */
    protected function getAPIMock()
    {
        return m::mock(Chatwork::class);
    }

    /**
     * @param string $fixture
     * @return array
     */
    protected function getMockResponse(string $fixture)
    {
        return require __DIR__."/Fixtures/{$fixture}.php";
    }
}
