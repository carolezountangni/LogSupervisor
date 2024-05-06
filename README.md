# LogSupervisor

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


Save all user logs on a Laravel Application
## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```
bin/        
build/
docs/
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
 composer require carolezountangni/log-supervisor
```


# Setup Migrations and Model


### Insérer le ServiceProvider dans le config/app.phpfichier :

``` php
'providers' => [
    // ...
    carolezountangni\LogSupervisor\Providers\LSupervisorProvider::class,
],
```
### Insérer le middleware dans le app/Http/Kernel.php fichier :

``` php
protected $routeMiddleware = [
       
        'activity' => \carolezountangni\LogSupervisor\Http\Middeleware\Activity::class,
    ];
```
### Créer la migration  :

``` php
php artisan migrate --path=vendor/carolezountangni/log-supervisor/src/Migrations

```


Make model with migration file at the same time.
<br/> Note: At the package the model used is under "App\Models\" then please do so.

```
php artisan make:model Activity -m
```

LlsActivity  Table Structure

```
```
Migrate table using composer and it's automatically create table in the database

```
php artisan migrate
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email czountangni@gmail.com instead of using the issue tracker.

## Credits

- [Carole Zountangni][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/carolezountangni/LogSupervisor.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/carolezountangni/LogSupervisor/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/carolezountangni/LogSupervisor.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/carolezountangni/LogSupervisor.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/carolezountangni/LogSupervisor.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/carolezountangni/LogSupervisor
[link-travis]: https://travis-ci.org/carolezountangni/LogSupervisor
[link-scrutinizer]: https://scrutinizer-ci.com/g/carolezountangni/LogSupervisor/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/carolezountangni/LogSupervisor
[link-downloads]: https://packagist.org/packages/carolezountangni/LogSupervisor
[link-author]: https://github.com/carolezountangni
[link-contributors]: ../../contributors
