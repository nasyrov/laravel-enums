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

        new EnumFixture('test');
        new EnumFixture(1234);
    }

    /** @test */
    public function it_converts_enum_value_to_string()
    {
        $this->assertEquals(
            EnumFixture::FOO,
            (string)new EnumFixture(EnumFixture::FOO)
        );
        $this->assertEquals(
            EnumFixture::BAR,
            (string)new EnumFixture(EnumFixture::BAR)
        );
    }

    /** @test */
    public function it_gets_enum_key()
    {
        $this->assertEquals(
            'FOO',
            (new EnumFixture(EnumFixture::FOO))->getKey()
        );
        $this->assertEquals(
            'BAR',
            (new EnumFixture(EnumFixture::BAR))->getKey()
        );
    }

    /** @test */
    public function it_gets_enum_value()
    {
        $this->assertEquals(
            EnumFixture::FOO,
            (new EnumFixture(EnumFixture::FOO))->getValue()
        );
        $this->assertEquals(
            EnumFixture::BAR,
            (new EnumFixture(EnumFixture::BAR))->getValue()
        );
    }

    /** @test */
    public function it_gets_enum_keys()
    {
        $this->assertEquals(['FOO', 'BAR'], EnumFixture::keys());
    }

    /** @test */
    public function it_gets_enum_values()
    {
        $this->assertEquals(
            [
                'FOO' => new EnumFixture(EnumFixture::FOO),
                'BAR' => new EnumFixture(EnumFixture::BAR),
            ],
            EnumFixture::values()
        );
    }

    /** @test */
    public function it_gets_enum_constants()
    {
        $this->assertInstanceOf(Collection::class, EnumFixture::constants());
        $this->assertEquals(
            [
                'FOO' => 'test',
                'BAR' => 123,
            ],
            EnumFixture::constants()->all()
        );
    }

    /** @test */
    public function it_provides_static_access()
    {
        $this->assertEquals(new EnumFixture(EnumFixture::FOO), EnumFixture::FOO());
        $this->assertEquals(new EnumFixture(EnumFixture::BAR), EnumFixture::BAR());
    }

    /** @test */
    public function it_cannot_provides_static_access_for_invalid_value()
    {
        $this->expectException(BadMethodCallException::class);

        EnumFixture::BAZ();
    }
}
