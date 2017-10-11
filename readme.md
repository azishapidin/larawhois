# LaraWhois

## Introduction
LaraWhois is Laravel 5 Package Wrapper for https://jsonwhoisapi.com/. To use this Package, we must have https://jsonwhoisapi.com/ Account (Account ID and API Key).

## Instalation
> This Package is Still on Development

This package is now Available on Packagist, just type this command on Terminal:
```php
composer require azishapidin/larawhois @dev
```

Next, add the ServiceProvider to the providers array in config/app.php
```php
AzisHapidin\LaraWhois\LaraWhoisProvider::class,
```

To publish the config file use:
```php
php artisan vendor:publish
```

This command will add ```larawhois.php``` to ```config``` folder.

## Usage
Will be updated in the future :smiley: