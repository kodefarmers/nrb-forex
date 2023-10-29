# NrbForex

_A laravel package to consume Nepal Rastra Bank's forex api._

[![Issues](https://img.shields.io/github/issues/kodefarmers/nrb-forex.svg?style=flat-square)](https://github.com/kodefarmers/nrb-forex/issues)
[![Latest Version](https://img.shields.io/github/v/release/kodefarmers/nrb-forex.svg?style=flat-square)](https://github.com/kodefarmers/nrb-forex/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/kodefarmers/nrb-forex.svg?style=flat-square)](https://packagist.org/packages/kodefarmers/nrb-forex)

NrbForex is a laravel package that allows for easy comsumption of forex API by Nepal Rastra Bank.

## Installation

You can install the package via Composer:

```bash
$ composer require kodefarmers/nrb-forex
```

The Laravel facade and service provider are registered through auto-discovery, so you can instantly start using it.

## Publish Config File

You can generate a config file by:

```
php artisan vendor:publish --tag=nrbforex
```

## Usage

This package publishes a Laravel facade for easier usage:

```php
use KodeFarmers\NrbForex\Facades\NrbForex;

return NrbForex::convert(1);
// returns 1 USD to NPR

return NrbForex::from('EUR')->convert(1);
// returns 1 EUR to NPR
```

## Contributing

We welcome contributions from the community! If you have an idea for a new feature or improvement, please submit a pull request. We also appreciate bug reports and other feedback.

To get started with contributing, simply fork this repository, make your changes, and submit a pull request.

## License

This project is licensed under [MIT](https://opensource.org/license/mit-0/)

## Self-Promotion

Star the repository on [Github](https://github.com/kodefarmers/nrb-forex)
Follow on [Github](https://github.com/kodefarmers)
