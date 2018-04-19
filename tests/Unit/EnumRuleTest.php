<?php

namespace Nasyrov\Laravel\Enums\Tests\Unit;

use Illuminate\Validation\Factory;
use Nasyrov\Laravel\Enums\Rules\EnumRule;
use PHPUnit\Framework\TestCase;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Container\Container;
use InvalidArgumentException;

class EnumRuleTest extends TestCase
{
    /** @test */
    public function enum_rule_is_valid()
    {
        $validator = $this->validator(
            [
                'enum' => 'test',
            ],
            [
                'enum' => new EnumRule(EnumFixture::class),
            ]
        );

        $this->assertTrue(!$validator->fails());
    }

    /** @test */
    public function enum_rule_is_invalid()
    {
        $validator = $this->validator(
            [
                'enum' => 'wrongenum',
            ],
            [
                'enum' => new EnumRule(EnumFixture::class),
            ]
        );

        $this->assertTrue($validator->fails());

        $this->assertEquals(
            [
                'The enum is not a valid value for the Nasyrov\Laravel\Enums\Enum'
            ],
            $validator->errors()->toArray()['enum']
        );
    }

    /** @test */
    public function enum_rule_bad_class()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnumRule('bad class');
    }

    protected function validator($attributes, $rules)
    {
        $loader = new FileLoader(new Filesystem, 'lang');
        $translator = new Translator($loader, 'en');
        $validation = new Factory($translator, new Container);


        return $validation->make($attributes, $rules);
    }
}
