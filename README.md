# Weaviate PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/timkley/weaviate-php.svg?style=flat-square)](https://packagist.org/packages/timkley/weaviate-php)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/timkley/weaviate-php/run-tests.yml?label=tests)](https://github.com/timkley/weaviate-php/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/timkley/weaviate-php.svg?style=flat-square)](https://packagist.org/packages/timkley/weaviate-php)

This is a wrapper around the [Weaviate REST API](https://weaviate.io/developers/weaviate/api/rest).

## Installation

### Requirements

> PHP 8.2 or PHP 8.3

### With composer

```bash
composer require timkley/weaviate-php
```

## Usage

This package supports API key authentication (available in Weaviate 1.18 and higher) or anonymous access. Please refer to the [official documentation](https://weaviate.io/developers/weaviate/configuration/authentication#api-key) for more information.

```php
<?php

use Weaviate\Weaviate;

$weaviate = new Weaviate('http://localhost:8080', 'your-token');

// using the GraphQL API
$weaviate->graphql()->get('{
    Get {
        Things {
            Article {
                title
            }
        }
    }
}');

// using the `batch` REST API
$weaviate->batch()->create($objects);

// adding query parameters
$weaviate->dataObject()->withQueryParameters(['limit' => 10])->get();
```

## Testing

```bash
composer test
```

## Credits

I took a lot of inspiration from existing packages like [mailgun/mailgun-php](https://github.com/mailgun/mailgun-php)
or [lepikhinb/fathom-api](https://github.com/lepikhinb/fathom-api).

And of course [Weaviate](https://weaviate.io/) for providing this great project.

Thanks for contributing to open source!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
