# Laravel Enum

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Laravel package for Enum implementation.

## Requirements

Make sure all dependencies have been installed before moving on:

* [PHP](http://php.net/manual/en/install.php) >= 5.6
* [Composer](https://getcomposer.org/download/)

## Install

First, pull the package via Composer:

``` bash
$ composer require nasyrov/laravel-enum
```

## Usage

Declare the enum:

``` php
use Nasyrov\Laravel\Enum\Enum;

/**
 * @method static UserStatusEnum ACTIVE()
 * @method static UserStatusEnum INACTIVE()
 */
class UserStatusEnum extends Enum
{
    const ACTIVE = 10;
    const INACTIVE = 20;
}
```

To call the enum simply new up the enum class or use the static methods:

``` php
$status = new UserStatusEnum(UserStatusEnum::ACTIVE);
$status = UserStatusEnum::ACTIVE();
```

Define and type-hint the model accessor:

``` php
public function getStatusAttribute($attribute) {
    return new UserStatusEnum($attribute);
}
```

Define and type-hint the model mutator:

``` php
public function setStatusAttribute(UserStatusEnum $attribute) {
    $this->attributes['status'] = $attribute->getValue();
}
```

Validation:

``` php
$this->validate($request, [
    'status' => [
        'required',
        Rule::in(UserStatusEnum::values()),
    ],
]);
```

## Testing

``` bash
$ composer lint
$ composer test
```

## Security

If you discover any security related issues, please email inasyrov@ya.ru instead of using the issue tracker.

## Credits

- [Evgenii Nasyrov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/nasyrov/laravel-enum.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nasyrov/laravel-enum/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nasyrov/laravel-enum.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nasyrov/laravel-enum.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nasyrov/laravel-enum.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nasyrov/laravel-enum
[link-travis]: https://travis-ci.org/nasyrov/laravel-enum
[link-scrutinizer]: https://scrutinizer-ci.com/g/nasyrov/laravel-enum/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nasyrov/laravel-enum
[link-downloads]: https://packagist.org/packages/nasyrov/laravel-enum
[link-author]: https://github.com/nasyrov
[link-contributors]: ../../contributors
