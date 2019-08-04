# Chatwork PHP API client library

[![Build Status](https://travis-ci.org/sun-asterisk-research/chatwork-php.svg?branch=master)](https://travis-ci.org/sun-asterisk-research/chatwork-php)

## Requirement

- PHP >= 7.0
- PHP cURL

## Usage

First register an API Token [here](https://www.chatwork.com/service/packages/chatwork/subpackages/api/token.php).

Here're some basic usage.

```php
// Create an authentication object, authentication using API token and OAuth access token are supported
$auth = new SunAsterisk\Chatwork\Auth\APIToken('your token');

// Create an API client instance
$chatwork = new SunAsterisk\Chatwork\Chatwork($auth);

// Call the API you need
$me = $chatwork->me();

print_r($me);
```

API methods are organized similar to the [official API doc](http://developer.chatwork.com/ja/endpoints.html) e.g.

```php
$tasks = $chatwork->my()->tasks();
$messages = $chatwork->room($roomId)->members();
```

## Message builder

There's a helper for easily creating message.

```php
use SunAsterisk\Chatwork\Helpers\Message;

$message = new Message('Hi there')
    ->info('Cloudy', 'Weather today');

$chatwork->room($roomId)->messages()->create((string) $message);
```

You can also access it via a static method of the `Chatwork` class.

```php
$message = Chatwork::message('Hi there');
```
