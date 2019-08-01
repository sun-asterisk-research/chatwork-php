<?php

namespace SunAsterisk\Chatwork\Exceptions;

class APIException extends \Exception
{
    /**
     * The response status code
     *
     * @var int
     */
    protected $status;

    /**
     * The response body
     *
     * @var array
     */
    protected $response;

    public function __construct(int $status, array $response)
    {
        $this->status = $status;
        $this->response = $response;
        $this->message = $response['errors'][0];
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }
}
