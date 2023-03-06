# Weaviate PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/timkley/weaviate-php.svg?style=flat-square)](https://packagist.org/packages/timkley/weaviate-php)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/timkley/weaviate-php/Run%20Tests?label=tests)](https://github.com/timkley/weaviate-php/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/timkley/weaviate-php.svg?style=flat-square)](https://packagist.org/packages/timkley/weaviate-php)

This is a wrapper around the [Weaviate REST API](https://weaviate.io/developers/weaviate/api/rest). It is still a WIP and not all endpoints are implemented.

## Installation

### Requirements

> PHP 8.1 or PHP 8.2

### With composer

```bash
composer require timkley/weaviate-php
```

## Usage

If you are using OIDC authentication, you need to provide a token. Otherwise you can use the `Weaviate` class directly.

You need to [obtain the token](https://weaviate.io/developers/weaviate/configuration/authentication#manually-obtaining-and-passing-tokens) and use it to initialize the client. 

```php
<?php

use Weaviate\Weaviate;

$weaviate = new Weaviate('http://localhost:8080', 'your-token');
```

## Testing

```bash
./vendor/bin/pest
```

## Todo

- [ ] Missing endpoints

## Credits

I took a lot of inspiration from existing packages like [mailgun/mailgun-php](https://github.com/mailgun/mailgun-php)
or [lepikhinb/fathom-api](https://github.com/lepikhinb/fathom-api).

And of course [Weaviate](https://weaviate.io/) for providing this great project.

Thanks for contributing to open source!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
