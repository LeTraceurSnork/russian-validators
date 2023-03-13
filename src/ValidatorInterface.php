<?php

declare(strict_types=1);

namespace LTS\RussianValidators;

/**
 * Allows to validate that a value matches a rule
 */
interface ValidatorInterface
{
    /**
     * Returns true if value matches the rule
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function validate(mixed $value): bool;
}
