# Laravel File Cache Cleaner

[![Total Downloads](https://img.shields.io/packagist/dt/imanghafoori/laravel-file-cache-cleaner.svg?style=flat-square)](https://packagist.org/packages/imanghafoori/laravel-file-cache-cleaner)
---
This is a command which lets you delete the expired cached data on the file system and free up the disk space.

## Installation

You can install the package via composer:

```bash
composer require imanghafoori/laravel-file-cache-cleaner
```

## Usage

```php
// default store:
php artisan cache:clean_files

// or custom store:
php artisan cache:clean_files my_store
```

![image](https://user-images.githubusercontent.com/6961695/152064458-7ee06ddb-cd3f-4a50-a853-342b4fd1ced4.png)


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
