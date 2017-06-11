<?php

namespace Nasyrov\Laravel\Enum\Tests\Unit;

use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class EnumTest extends TestCase
{
    /** @test */
    public function it_cannot_create_enum_with_invalid_value()
    {
        $this->expectException(UnexpectedValueException::class);

        new EnumStub('test');
        new EnumStub(1234);
    }
}
