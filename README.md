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

// Call your desired API
$me = $chatwork->me();

print_r($me);
```
