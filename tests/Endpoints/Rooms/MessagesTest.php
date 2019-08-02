<?php

use SunAsterisk\Chatwork\Endpoints\Rooms\Messages;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class MessagesTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testGetRoomMessages()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/messages', [
            'force' => true,
        ])->andReturn(['response']);

        $messages = new Messages($api, 123);

        $this->assertEquals(['response'], $messages->list(['force' => true]));
    }

    public function testCreateMessage()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('post')->with('rooms/123/messages', [
            'body' => 'Hi there',
        ])->andReturn(['response']);

        $messages = new Messages($api, 123);

        $this->assertEquals(['response'], $messages->create('Hi there'));
    }

    public function testMarkMessageAsRead()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('put')->with('rooms/123/messages/read', [
            'message_id' => 101,
        ])->andReturn(['response']);

        $messages = new Messages($api, 123);

        $this->assertEquals(['response'], $messages->markAsRead(101));
    }

    public function testMarkMessageAsUnread()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('put')->with('rooms/123/messages/unread', [
            'message_id' => 101,
        ])->andReturn(['response']);

        $messages = new Messages($api, 123);

        $this->assertEquals(['response'], $messages->markAsUnread(101));
    }

    public function testGetMessageDetail()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/messages/101')->andReturn(['response']);

        $messages = new Messages($api, 123);

        $this->assertEquals(['response'], $messages->detail(101));
    }

    public function testUpdateMessage()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('put')->with('rooms/123/messages/101', [
            'body' => 'Hi there',
        ])->andReturn(['response']);

        $messages = new Messages($api, 123);

        $this->assertEquals(['response'], $messages->update(101, 'Hi there'));
    }

    public function testDeleteMessage()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('delete')->with('rooms/123/messages/101');

        $messages = new Messages($api, 123);

        $messages->delete(101);
    }
}
