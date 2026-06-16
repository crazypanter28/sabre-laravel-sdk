# Sabre Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/TU_USUARIO/sabre-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/TU_USUARIO/sabre-laravel-sdk)
[![Tests](https://img.shields.io/github/actions/workflow/status/TU_USUARIO/sabre-laravel-sdk/tests.yml?label=tests&style=flat-square)](https://github.com/TU_USUARIO/sabre-laravel-sdk/actions)
[![License](https://img.shields.io/github/license/TU_USUARIO/sabre-laravel-sdk?style=flat-square)](LICENSE.md)

A clean Laravel SDK for the [Sabre GDS REST API](https://developer.sabre.com). No more raw HTTP calls — just elegant Laravel-style integration.

> 🤖 This package is 100% built with AI assistance as an open source community project.

## Requirements

- PHP 8.1+
- Laravel 10.x / 11.x / 12.x

## Installation

```bash
composer require crazypanter28/sabre-laravel-sdk
```

Publish the config file:

```bash
php artisan vendor:publish --tag=sabre-config
```

## Configuration

Add to your `.env` file:

```env
SABRE_CLIENT_ID=your_client_id
SABRE_CLIENT_SECRET=your_client_secret
SABRE_PCC=your_pcc
SABRE_ENVIRONMENT=test
```

## Usage

### Authentication

```php
use SabreLaravel\Facades\SabreAuth;

// Get token (cached automatically for 6 days)
$token = SabreAuth::getToken();

// Force refresh token
$token = SabreAuth::refreshToken();
```

### Passengers

```php
use SabreLaravel\Facades\SabrePassenger;

$passengers = SabrePassenger::list('ABC123');
```

## Roadmap

- [x] v0.1.0 — Authentication + Passenger List
- [ ] v0.2.0 — Flight availability / BargainFinder
- [ ] v0.3.0 — Create PNR / Booking
- [ ] v0.4.0 — Hotels search
- [ ] v1.0.0 — Stable release

## Contributing

Contributions are welcome! Please open an issue or submit a PR.

## License

MIT
