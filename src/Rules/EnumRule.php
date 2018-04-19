<?php

namespace Nasyrov\Laravel\Enums\Rules;

use Illuminate\Contracts\Validation\Rule;
use Nasyrov\Laravel\Enums\Enum;
use ReflectionClass;
use InvalidArgumentException;

class EnumRule implements Rule
{
    /** @property string $enumClass */
    protected $enumClass;

    /**
    * @param string $enumClass Class of the enum to validate against
    */
    public function __construct(string $enumClass)
    {
        if (!$this->isEnumClass($enumClass)) {
            throw new InvalidArgumentException(
                $this->invalidEnumMessage($enumClass)
            );
        }

        $this->enumClass = $enumClass;
    }

    /**
     * Determine if the validation rule is an valid enum.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $values = $this->enumClass::constants()->flip();

        return $values->has($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid value for the ' . Enum::class;
    }

    /**
     * Validate that the given class is an Enum
     *
     * @param string $enumClass
     *
     * @return bool
     */
    protected function isEnumClass(string $enumClass): bool
    {
        return !(!class_exists($enumClass)
            || !(new ReflectionClass($enumClass))->isSubclassOf(Enum::class));
    }

    /**
     * Pretty error message to indicate which class to implement
     *
     * @param string $enumClass
     *
     * @return string
     */
    protected function invalidEnumMessage(string $enumClass): string
    {
        return sprintf(
            '%s needs to be valid and implement %s for the EnumRule',
            $enumClass,
            Enum::class
        );
    }
}
