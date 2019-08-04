<?php

namespace SunAsterisk\Chatwork\Helpers;

use DateTime;

class Message
{
    protected $body;

    public function __construct(string $text = null)
    {
        $this->body = $text ?: "";
    }

    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->body;
    }

    /**
     * @param  string $text
     * @return self
     */
    public function text(string $text)
    {
        $this->body .= $text;

        return $this;
    }

    /**
     * @param  string $text
     * @return self
     */
    public function line(string $text)
    {
        $this->body .= "{$text}\n";

        return $this;
    }

    /**
     * @param  string $body
     * @param  string|null $title
     * @return self
     */
    public function info(string $body, string $title = null)
    {
        return $this->infoStart($title)
            ->text($body)
            ->infoEnd();
    }

    /**
     * @param  string|null $title
     * @return self
     */
    public function infoStart(string $title = null)
    {
        $this->body .= "[info]";
        if ($title) {
            $this->body .= "[title]{$title}[/title]";
        }

        return $this;
    }

    /**
     * @return self
     */
    public function infoEnd()
    {
        $this->body .= "[/info]";

        return $this;
    }

    /**
     * @param  string $content
     * @return self
     */
    public function code(string $content)
    {
        $this->body .= "[code]{$content}[/code]";

        return $this;
    }

    /**
     * @param  integer $accountId
     * @param  string|null $name
     * @return self
     */
    public function to($accountId, string $name = null)
    {
        $this->body .= "[To:{$accountId}]";
        if ($name) {
            $this->body .= " {$name}";
        }

        return $this;
    }

    /**
     * @return self
     */
    public function toAll()
    {
        $this->body .= '[toall]';

        return $this;
    }

    /**
     * @param  int $accountId The user to reply to
     * @param  int $roomId    The room where the message was originally created
     * @param  int $messageId The message to reply to
     * @return self
     */
    public function reply($accountId, $roomId, $messageId, string $name = null)
    {
        $this->body .= "[rp aid={$accountId} to={$roomId}-{$messageId}]";
        if ($name) {
            $this->body .= " {$name}";
        }

        return $this;
    }

    /**
     * @param  int $accountId User to quote
     * @param  DateTime $time Time at which the user said the quoted text
     * @param  string $text   Quoted text
     * @return self
     */
    public function quote($accountId, DateTime $time, string $text)
    {
        return $this->quoteStart($accountId, $time)
            ->text($text)
            ->quoteEnd();
    }

    /**
     * @param  int $accountId User to quote
     * @param  DateTime $time Time at which the user said the quoted text
     * @return self
     */
    public function quoteStart($accountId, DateTime $time = null)
    {
        $timestamp = $time ? " time={$time->getTimestamp()}" : "";
        $this->body .= "[qt][qtmeta aid={$accountId}{$timestamp}]";

        return $this;
    }

    /**
     * @return self
     */
    public function quoteEnd()
    {
        $this->body .= "[/qt]";

        return $this;
    }
}
