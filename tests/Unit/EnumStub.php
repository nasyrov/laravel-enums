<?php

namespace Nasyrov\Laravel\Enum\Tests\Unit;

use Nasyrov\Laravel\Enum\Enum;

/**
 * @method static EnumStub FOO()
 * @method static EnumStub BAR()
 */
class EnumStub extends Enum
{
    const FOO = 'test';
    const BAR = 123;
}
