<?php

namespace SunAsterisk\Chatwork\Auth;

class AccessToken implements Auth
{
    /** @var string */
    protected $accessToken;

    /**
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer {$this->accessToken}",
        ];
    }
}
