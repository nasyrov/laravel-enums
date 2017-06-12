<?php

namespace Nasyrov\Laravel\Enum\Tests\Unit;

use Nasyrov\Laravel\Enum\Enum;

/**
 * @method static EnumFixture FOO()
 * @method static EnumFixture BAR()
 */
class EnumFixture extends Enum
{
    const FOO = 'test';
    const BAR = 123;
}
