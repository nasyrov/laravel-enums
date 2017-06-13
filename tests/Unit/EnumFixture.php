<?php

namespace Nasyrov\Laravel\Enums\Tests\Unit;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static EnumFixture FOO()
 * @method static EnumFixture BAR()
 */
class EnumFixture extends Enum
{
    const FOO = 'test';
    const BAR = 123;
}
