# Laravel File Cache Cleaner

[![Latest Version on Packagist](https://img.shields.io/packagist/v/imanghafoori/laravel-file-cache-cleaner.svg?style=flat-square)](https://packagist.org/packages/imanghafoori/laravel-file-cache-cleaner)
[![Tests](https://github.com/imanghafoori/laravel-file-cache-cleaner/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/imanghafoori/laravel-file-cache-cleaner/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/imanghafoori/laravel-file-cache-cleaner.svg?style=flat-square)](https://packagist.org/packages/imanghafoori/laravel-file-cache-cleaner)
<!--delete-->
---
This is a command which lets you delete the expired cached data on the file system and free up the disk space.

## Installation

You can install the package via composer:

```bash
composer require imanghafoori/laravel-file-cache-cleaner
```

## Usage

```php
php artisan cache:clean_files
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Iman Ghafoori](https://github.com/imanghafoori1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
