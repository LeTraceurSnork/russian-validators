<?php

declare(strict_types=1);

namespace LTS\RussianValidators;

use InvalidArgumentException;

/**
 * Abstract class that can validate a value matches a pattern
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * Default pattern to purify incoming digits is [-+\/\*\\_\.,\s]
     */
    public const DEFAULT_PURIFY_PATTERN = '[-+\/\*\\_\.,\s]';

    /**
     * Whether or not validator shall throw exceptions if $value is invalid
     *
     * @var bool
     */
    protected bool $throw_on_invalid;

    /**
     * Regexp pattern to purify incoming value from non-digits
     *
     * @var string
     */
    protected string $purify_pattern;

    /**
     *
     */
    public function __construct()
    {
        $this->throw_on_invalid = false;
        $this->purify_pattern   = self::DEFAULT_PURIFY_PATTERN;
    }

    /**
     * Turn the "Throw Exception on invalid value" option on
     *
     * @return $this
     */
    public function throwErrorOnInvalid(): self
    {
        $this->throw_on_invalid = true;

        return $this;
    }

    /**
     * Replace default $purify_pattern
     *
     * @param string $purify_pattern
     *
     * @return $this
     */
    public function setPurifyPattern(string $purify_pattern): self
    {
        $this->purify_pattern = $purify_pattern;

        return $this;
    }

    /**
     * Validates value to match some rule. Returns true/false
     * throws an InvalidArgumentException if fails and option `throwErrorOnInvalid` is set
     *
     * @param mixed $value
     *
     * @return bool
     * @throws InvalidArgumentException
     */
    abstract public function validate(mixed $value): bool;

    /**
     * Validation fails. If `throwErrorOnInvalid` option is set, throws an Exception
     *
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function endOnInvalid(): bool
    {
        if ($this->throw_on_invalid) {
            throw new InvalidArgumentException();
        }

        return false;
    }

    /**
     * Returns stringified $value
     * If purifyOnValidate() option enabled, purifies $value as well
     *
     * @param mixed $value
     *
     * @return string
     */
    protected function stringify(mixed $value): string
    {
        return preg_replace("/{$this->purify_pattern}/", '', (string)$value);
    }
}
