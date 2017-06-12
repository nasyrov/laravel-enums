<?php

namespace Nasyrov\Laravel\Enum\Tests\Unit;

use BadMethodCallException;
use Illuminate\Support\Collection;
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

    /** @test */
    public function it_converts_enum_value_to_string()
    {
        $this->assertEquals(
            EnumStub::FOO,
            (string)new EnumStub(EnumStub::FOO)
        );
        $this->assertEquals(
            EnumStub::BAR,
            (string)new EnumStub(EnumStub::BAR)
        );
    }

    /** @test */
    public function it_gets_enum_key()
    {
        $this->assertEquals(
            'FOO',
            (new EnumStub(EnumStub::FOO))->getKey()
        );
        $this->assertEquals(
            'BAR',
            (new EnumStub(EnumStub::BAR))->getKey()
        );
    }

    /** @test */
    public function it_gets_enum_value()
    {
        $this->assertEquals(
            EnumStub::FOO,
            (new EnumStub(EnumStub::FOO))->getValue()
        );
        $this->assertEquals(
            EnumStub::BAR,
            (new EnumStub(EnumStub::BAR))->getValue()
        );
    }

    /** @test */
    public function it_gets_enum_keys()
    {
        $this->assertEquals(['FOO', 'BAR'], EnumStub::keys());
    }

    /** @test */
    public function it_gets_enum_values()
    {
        $this->assertEquals(
            [
                'FOO' => new EnumStub(EnumStub::FOO),
                'BAR' => new EnumStub(EnumStub::BAR),
            ],
            EnumStub::values()
        );
    }

    /** @test */
    public function it_gets_enum_constants()
    {
        $this->assertInstanceOf(Collection::class, EnumStub::constants());
        $this->assertEquals(
            [
                'FOO' => 'test',
                'BAR' => 123,
            ],
            EnumStub::constants()->all()
        );
    }

    /** @test */
    public function it_provides_static_access()
    {
        $this->assertEquals(new EnumStub(EnumStub::FOO), EnumStub::FOO());
        $this->assertEquals(new EnumStub(EnumStub::BAR), EnumStub::BAR());
    }

    /** @test */
    public function it_cannot_provides_static_access_for_invalid_value()
    {
        $this->expectException(BadMethodCallException::class);

        EnumStub::BAZ();
    }
}
