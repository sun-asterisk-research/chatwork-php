<?php

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param  string $fixture
     * @return array
     */
    protected function getMockResponse($fixture)
    {
        return require __dir__."/Fixtures/{$fixture}.php";
    }
}
