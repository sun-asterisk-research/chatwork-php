<?php

use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\IncomingRequests;

class IncomingRequestsTest extends TestCase
{
    public function testGetIncomingRequests()
    {
        /** @var Chatwork $api */
        $api = $this->getAPIMock();
        $api->shouldReceive('get')
            ->with('incoming_requests')
            ->andReturns(['response']);

        $incomingRequests = new IncomingRequests($api);

        $this->assertEquals(['response'], $incomingRequests->list());
    }

    public function testAcceptContactRequest()
    {
        /** @var Chatwork $api */
        $api = $this->getAPIMock();
        $api->shouldReceive('put')
            ->with('incoming_requests/123')
            ->andReturns(['response']);

        $incomingrequests = new IncomingRequests($api);

        $this->assertEquals(['response'], $incomingrequests->accept(123));
    }

    public function testRejectContactRequest()
    {
        /** @var Chatwork $api */
        $api = $this->getAPIMock();
        $api->shouldReceive('delete')
            ->with('incoming_requests/123')
            ->andReturns(['response']);

        $incomingrequests = new IncomingRequests($api);

        $this->assertEquals(['response'], $incomingrequests->reject(123));
    }
}
