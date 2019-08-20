<?php

namespace SunAsterisk\Chatwork;

use GuzzleHttp\Client;
use SunAsterisk\Chatwork\Auth\Auth;
use function GuzzleHttp\json_decode;
use SunAsterisk\Chatwork\Auth\APIToken;
use GuzzleHttp\Exception\ClientException;
use SunAsterisk\Chatwork\Helpers\Message;
use SunAsterisk\Chatwork\Auth\AccessToken;
use SunAsterisk\Chatwork\Exceptions\APIException;

/**
 * @method array me()
 * @method array contacts()
 * @method \SunAsterisk\Chatwork\Endpoints\IncomingRequests incomingRequests()
 * @method \SunAsterisk\Chatwork\Endpoints\My my()
 * @method \SunAsterisk\Chatwork\Endpoints\Room room(int $id)
 * @method \SunAsterisk\Chatwork\Endpoints\Rooms rooms()
 */
class Chatwork
{
    /** @Client */
    protected $client;

    const API_URI = 'https://api.chatwork.com';
    const API_VERSION = 'v2';

    /**
     * Create an API client
     *
     * @param string $apiToken
     * @param array $options
     */
    public function __construct(Auth $auth)
    {
        $this->client = new Client([
            'base_uri' => static::API_URI.'/'.static::API_VERSION.'/',
            'timeout' => 30,
            'headers' => array_merge([
                'Accept' => 'application/json',
            ], $auth->getHeaders()),
        ]);
    }

    /**
     * Create a new Chatwork client instance via an api token.
     *
     * @param string $token
     * @return static
     */
    public static function withAPIToken(string $token)
    {
        return new static(new APIToken($token));
    }

    /**
     * Create a new Chatwork client instance via an access token.
     *
     * @param string $token
     * @return static
     */
    public static function withAccessToken(string $token)
    {
        return new static(new AccessToken($token));
    }

    public function __call($name, $arguments)
    {
        $endpointClass = __NAMESPACE__.'\\Endpoints\\'.ucfirst($name);
        $endpoint = new $endpointClass($this, ...$arguments);

        return is_callable($endpoint) ? $endpoint() : $endpoint;
    }

    /**
     * @param  string $text
     * @return Message
     */
    public static function message(string $text = null)
    {
        return new Message($text);
    }

    /**
     * @param  string $uri
     * @param  array $query
     * @return mixed
     */
    public function get(string $uri, array $query = [])
    {
        return $this->request('GET', $uri, [
            'query' => $query,
        ]);
    }

    /**
     * @param  string $uri
     * @param  array $data
     * @return mixed
     */
    public function post(string $uri, array $data = [])
    {
        return $this->request('POST', $uri, [
            'form_params' => $data,
        ]);
    }

    /**
     * @param  string $uri
     * @param  array $data
     * @return mixed
     */
    public function put(string $uri, array $data = [])
    {
        return $this->request('PUT', $uri, [
            'form_params' => $data,
        ]);
    }

    /**
     * @param  string $uri
     * @param  array $data
     * @return mixed
     */
    public function patch(string $uri, array $data = [])
    {
        return $this->request('PATCH', $uri, [
            'form_params' => $data,
        ]);
    }

    /**
     * @param  string $uri
     * @param  array $query
     */
    public function delete(string $uri, array $query = [])
    {
        $this->request('DELETE', $uri, [
            'query' => $query,
        ]);
    }

    /**
     * @param  string $method
     * @param  string $uri
     * @param  array $options
     * @return mixed
     */
    public function request(string $method, $uri = '', array $options = [])
    {
        try {
            $res = $this->client->request($method, $uri, $options);

            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody()->getContents(), true);

            throw new APIException($response->getStatusCode(), $body);
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }
}
