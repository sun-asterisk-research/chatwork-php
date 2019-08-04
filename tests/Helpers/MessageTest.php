<?php

use SunAsterisk\Chatwork\Helpers\Message;

class MessageTest extends TestCase
{
    public function testToString()
    {
        $message = new Message('Hi there');
        $this->assertEquals('Hi there', $message->toString());
        $this->assertEquals('Hi there', (string) $message);
    }

    public function testText()
    {
        $message = (new Message())->text('Hi there');
        $this->assertEquals('Hi there', $message->toString());
    }

    public function testLine()
    {
        $message = (new Message())->line('Hi there');
        $this->assertEquals("Hi there\n", $message->toString());
    }

    public function testInfoStart()
    {
        $message = (new Message())->infoStart();
        $this->assertEquals('[info]', $message->toString());

        $message = (new Message())->infoStart('Weather');
        $this->assertEquals('[info][title]Weather[/title]', $message->toString());
    }

    public function testInfoEnd()
    {
        $message = (new Message())->infoEnd();
        $this->assertEquals('[/info]', $message->toString());
    }

    public function testInfo()
    {
        $message = (new Message())->info('Cloudy', 'Weather');
        $this->assertEquals('[info][title]Weather[/title]Cloudy[/info]', $message->toString());

        $message = (new Message())->info('Hi there');
        $this->assertEquals('[info]Hi there[/info]', $message->toString());
    }

    public function testCode()
    {
        $message = (new Message())->code('echo Hi there');
        $this->assertEquals('[code]echo Hi there[/code]', $message->toString());
    }

    public function testTo()
    {
        $message = (new Message())->to(123);
        $this->assertEquals('[To:123]', $message->toString());

        $message = (new Message())->to(123, 'John Smith');
        $this->assertEquals('[To:123] John Smith', $message->toString());
    }

    public function testToAll()
    {
        $message = (new Message())->toAll();
        $this->assertEquals('[toall]', $message->toString());
    }

    public function testReply()
    {
        $message = (new Message())->reply(123, 100, 10111001, 'John Smith');
        $this->assertEquals('[rp aid=123 to=100-10111001] John Smith', $message->toString());

        $message = (new Message())->reply(123, 100, 10111001);
        $this->assertEquals('[rp aid=123 to=100-10111001]', $message->toString());
    }

    public function testQuoteStart()
    {
        $message = (new Message())->quoteStart(123, new DateTime('2018-08-01 00:00:00'));
        $this->assertEquals('[qt][qtmeta aid=123 time=1533081600]', $message->toString());

        $message = (new Message())->quoteStart(123);
        $this->assertEquals('[qt][qtmeta aid=123]', $message->toString());
    }

    public function testQuoteEnd()
    {
        $message = (new Message())->quoteEnd();
        $this->assertEquals('[/qt]', $message->toString());
    }

    public function testQuote()
    {
        $message = (new Message())->quote(123, new DateTime('2018-08-01 00:00:00'), 'Hi there');
        $this->assertEquals('[qt][qtmeta aid=123 time=1533081600]Hi there[/qt]', $message->toString());
    }
}
