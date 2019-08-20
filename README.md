# Chatwork PHP API client library

[![Build Status](https://travis-ci.org/sun-asterisk-research/chatwork-php.svg?branch=master)](https://travis-ci.org/sun-asterisk-research/chatwork-php)
[![Latest Stable Version](https://poser.pugx.org/sun-asterisk/chatwork-php/v/stable)](https://packagist.org/packages/sun-asterisk/chatwork-php)
[![Codecov](https://img.shields.io/codecov/c/github/sun-asterisk-research/chatwork-php)](https://codecov.io/gh/sun-asterisk-research/chatwork-php)
![GitHub](https://img.shields.io/github/license/sun-asterisk-research/chatwork-php.svg)

## Requirements

- PHP >= 7.0
- PHP cURL

## Installation

Using composer:

```sh
composer require sun-asterisk/chatwork-php
```

## Usage

You may register an API Token [here](https://www.chatwork.com/service/packages/chatwork/subpackages/api/token.php).

Create a chatwork client with an api token or an access token:

```php

use SunAsterisk\Chatwork\Chatwork;

$chatwork = Chatwork::withAPIToken('your-api-token');

// $chatwork = Chatwork::withAccessToken('your-access-token');
```

Use chatwork client methods as these examples below:

```php

// Get your personal information.
$me = $chatwork->me();

// Get your personal tasks.
$tasks = $chatwork->my()->tasks();

// Get members in a room.
$members = $chatwork->room($roomId)->members();
```

API methods are organized similar to the [official API doc](http://developer.chatwork.com/ja/endpoints.html) e.g.

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

## Verify webhook payload

There's also a helper for verifying the webhook payload signature.

```php
use SunAsterisk\Chatwork\Helpers\Webhook;

$isValid = Webhook::verifySignature($yourWebhookToken, $requestBody, $signature);
```
