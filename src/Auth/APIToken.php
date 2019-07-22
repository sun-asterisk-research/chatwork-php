<?php

namespace SunAsterisk\Chatwork\Auth;

class APIToken implements Auth
{
    /** @var string */
    protected $apiToken;

    /**
     * @param string $apiToken
     */
    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function getHeaders(): array
    {
        return [
            'X-ChatworkToken' => $this->apiToken,
        ];
    }
}
