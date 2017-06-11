<?php

namespace Nasyrov\Laravel\Enum;

use ReflectionClass;
use UnexpectedValueException;

abstract class Enum
{
    /**
     * The enum value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * The enum constants.
     *
     * @var array
     */
    protected static $constants = [];

    /**
     * Create a new enum instance.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        if (!static::constants()->containsStrict($value)) {
            throw new UnexpectedValueException(sprintf(
                'Value `%s` is not part of the enum %s',
                $value,
                static::class
            ));
        }

        $this->value = $value;
    }

    /**
     * Get the enum constants.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function constants()
    {
        if (!isset(static::$constants[static::class])) {
            static::$constants[static::class] = collect(
                (new ReflectionClass(static::class))->getConstants()
            );
        }

        return static::$constants[static::class];
    }
}
