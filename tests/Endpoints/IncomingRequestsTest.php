<?php

use Mockery as m;

use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\IncomingRequests;

class IncomingRequestsTest extends TestCase
{
    protected $response;
    protected $requestId;

    protected function setUp(): void
    {
        $response = $this->getMockResponse('incomingrequests');
        $resquestId = $this->response['requestId'];
    }

    public function testGetIncomingRequests()
    {
        /** @var Chatwork $api */
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('get')
            ->with('incoming_requests')
            ->andReturns($this->response['incomingrequests']);

        $incomingrequests = new IncomingRequests($api);

        $this->assertEquals($this->response['incomingrequests'], $incomingrequests->getIncomingRequests());
    }

    public function testAcceptContactRequest()
    {
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('put')
            ->with(sprintf('incoming_requests/%d', $this->requestId))
            ->andReturns($this->response['acceptcontact']);

        $incomingrequests = new IncomingRequests($api);

        $this->assertEquals($this->response['incomingrequests'], $incomingrequests->acceptContactRequest($this->requestId));
    }

    public function testRejectContactRequest()
    {
        $api = m::mock(Chatwork::class);
        $api->shouldReceive('delete')
            ->with(sprintf('incoming_requests/%d', $this->requestId))
            ->andReturns($this->response['rejectcontact']);

        $incomingrequests = new IncomingRequests($api);

        $this->assertEquals($this->response['rejectcontact'], $incomingrequests->rejectContactRequest($this->requestId));
    }
}
