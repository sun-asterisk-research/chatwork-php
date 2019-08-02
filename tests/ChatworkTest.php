<?php

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use SunAsterisk\Chatwork\Auth\APIToken;
use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Endpoints\My;
use SunAsterisk\Chatwork\Endpoints\Rooms;
use SunAsterisk\Chatwork\Endpoints\Room;
use SunAsterisk\Chatwork\Endpoints\IncomingRequests;
use SunAsterisk\Chatwork\Exceptions\APIException;

class ChatworkTest extends TestCase
{
    /**
     * @dataProvider chatworkEndpoints
     */
    public function testGetChatworkEndpoint($method, $endpointClassname, $args = [])
    {
        $api = new Chatwork($this->getAuth());
        $endpoint = $api->$method(...$args);
        $this->assertInstanceOf($endpointClassname, $endpoint);
    }

    public function testRequest()
    {
        $history = [];
        $mockResponses = new MockHandler([
            new Response(200, [], '"response"'),
        ]);

        $api = $this->getInstanceMock($mockResponses, $history);

        $result = $api->request('GET', 'test');

        $this->assertEquals('response', $result);

        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals($this->uri('test'), (string) $request->getUri());
        $this->assertContains('secret', $request->getHeader('X-ChatworkToken'));
    }

    public function testThrowAPIException()
    {
        $history = [];
        $mockResponses = new MockHandler([
            new Response(404, [], json_encode([
                'errors' => [
                    'The message is not found',
                ]
            ])),
        ]);

        $api = $this->getInstanceMock($mockResponses, $history);

        $this->expectException(APIException::class);
        $this->expectExceptionMessage('The message is not found');
        $api->request('test');
    }

    public function testGet()
    {
        $history = [];
        $mockResponses = new MockHandler([
            new Response(200, [], '{"id":1}'),
        ]);

        $api = $this->getInstanceMock($mockResponses, $history);

        $result = $api->get('test', ['a' => 'b']);

        $this->assertEquals([
            'id' => 1,
        ], $result);

        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals($this->uri('test').'?a=b', (string) $request->getUri());
        $this->assertContains('secret', $request->getHeader('X-ChatworkToken'));
    }

    /**
     * @dataProvider requestMethods
     */
    public function testRequestWithBody($method, $expected)
    {
        $history = [];
        $mockResponses = new MockHandler([
            new Response(200, [], '{"id":1}'),
        ]);

        $api = $this->getInstanceMock($mockResponses, $history);

        $result = $api->$method('test', ['a' => 'b']);

        $this->assertEquals([
            'id' => 1,
        ], $result);

        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals($expected, $request->getMethod());
        $this->assertEquals($this->uri('test'), (string) $request->getUri());
        $this->assertEquals('a=b', $request->getBody()->getContents());
        $this->assertContains('secret', $request->getHeader('X-ChatworkToken'));
    }

    public function testDelete()
    {
        $history = [];
        $mockResponses = new MockHandler([
            new Response(204, [], '""'),
        ]);

        $api = $this->getInstanceMock($mockResponses, $history);

        $result = $api->delete('test', ['a' => 'b']);

        $this->assertEquals('', $result);

        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals($this->uri('test').'?a=b', (string) $request->getUri());
        $this->assertContains('secret', $request->getHeader('X-ChatworkToken'));
    }

    protected function getInstanceMock($responses, &$history)
    {
        $api = new Chatwork($this->getAuth());

        $reflection = new ReflectionClass($api);
        $clientProp = $reflection->getProperty('client');
        $clientProp->setAccessible(true);

        $handler = HandlerStack::create($responses);
        $handler->push(Middleware::history($history));

        $clientConfig = $clientProp->getValue($api)->getConfig();

        $client = new Client(array_merge($clientConfig, [
            'handler' => $handler,
        ]));

        $clientProp->setValue($api, $client);

        return $api;
    }

    protected function getAuth()
    {
        return new APIToken('secret');
    }

    protected function uri($endpoint)
    {
        return Chatwork::API_URI.'/'.Chatwork::API_VERSION.'/'.$endpoint;
    }

    public function requestMethods()
    {
        return [
            ['post', 'POST'],
            ['put', 'PUT'],
            ['patch', 'PATCH'],
        ];
    }

    public function chatworkEndpoints()
    {
        return [
            ['my', My::class],
            ['rooms', Rooms::class],
            ['room', Room::class, [1]],
            ['incomingRequests', IncomingRequests::class],
        ];
    }
}
