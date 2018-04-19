# Laravel Enums

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Laravel package for Enum implementation.

## Requirements

Make sure all dependencies have been installed before moving on:

* [PHP](http://php.net/manual/en/install.php) >= 7.0
* [Composer](https://getcomposer.org/download/)

## Install

Pull the package via Composer:

``` bash
$ composer require nasyrov/laravel-enums
```

Register the service provider in `config/app.php`:

``` php
'providers' => [
    ...
    Nasyrov\Laravel\Enums\EnumServiceProvider::class,
    ...
]
```

## Usage

Generate a new enum class via the command:

``` bash
$ php artisan make:enum UserStatusEnum
```

Define the enum constants:

``` php
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

To use the enum new up the instance or simply call via the static methods:

``` php
$status = new UserStatusEnum(UserStatusEnum::ACTIVE);
$status = UserStatusEnum::ACTIVE();
```

Type-hint the model accessor:

``` php
public function getStatusAttribute($attribute) {
    return new UserStatusEnum($attribute);
}
```

Type-hint the model mutator:

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

Localization:

``` php
use Nasyrov\Laravel\Enums\Enum as BaseEnum;

abstract class Enum extends BaseEnum
{
    /**
     * Get the enum labels.
     *
     * @return array
     */
    public static function labels()
    {
        return static::constants()
            ->flip()
            ->map(function ($key) {
                // Place your translation strings in `resources/lang/en/enum.php`
                return trans(sprintf('enum.%s', strtolower($key)));
            })
            ->all();
    }
}
```

``` blade
<select name="status">
    @foreach (UserStatusEnum::labels() as $value => $label)
        <option value="{{ $value }}">
            {{ $label }}
        </option>
    @endforeach
</select>
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

[ico-version]: https://img.shields.io/packagist/v/nasyrov/laravel-enums.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nasyrov/laravel-enums/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nasyrov/laravel-enums.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nasyrov/laravel-enums.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nasyrov/laravel-enums.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nasyrov/laravel-enums
[link-travis]: https://travis-ci.org/nasyrov/laravel-enums
[link-scrutinizer]: https://scrutinizer-ci.com/g/nasyrov/laravel-enums/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nasyrov/laravel-enums
[link-downloads]: https://packagist.org/packages/nasyrov/laravel-enums
[link-author]: https://github.com/nasyrov
[link-contributors]: ../../contributors
