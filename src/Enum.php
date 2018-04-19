<?php

namespace Nasyrov\Laravel\Enums;

use BadMethodCallException;
use ReflectionClass;
use UnexpectedValueException;
use JsonSerializable;

abstract class Enum implements JsonSerializable
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
        if (!static::constants()->contains($value)) {
            throw new UnexpectedValueException(sprintf(
                'Value `%s` is not part of the enum %s',
                $value,
                static::class
            ));
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * Get the serialized value.
     *
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->value;
    }

    /**
     * Get the enum key.
     *
     * @return mixed
     */
    public function getKey()
    {
        return static::constants()->search($this->value, true);
    }

    /**
     * Get the enum value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the enum keys.
     *
     * @return array
     */
    public static function keys()
    {
        return static::constants()
            ->keys()
            ->all();
    }

    /**
     * Get the enum values.
     *
     * @return array
     */
    public static function values()
    {
        return static::constants()
            ->map(function ($value) {
                return new static($value);
            })
            ->all();
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

    /**
     * Returns a new enum instance when called statically.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     */
    public static function __callStatic($name, array $arguments)
    {
        if (static::constants()->has($name)) {
            return new static(static::constants()->get($name));
        }

        throw new BadMethodCallException(sprintf(
            'No static method or enum constant `%s` in class %s',
            $name,
            static::class
        ));
    }
}
