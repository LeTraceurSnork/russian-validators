<?php

namespace LTS\RussianValidators;

/**
 * Class for validate KPP (Russian INN additional identifier)
 *
 * @link https://ru.wikipedia.org/wiki/%D0%98%D0%B4%D0%B5%D0%BD%D1%82%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80_%D0%BD%D0%B0%D0%BB%D0%BE%D0%B3%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D1%89%D0%B8%D0%BA%D0%B0#%D0%9A%D0%BE%D0%B4_%D0%BF%D1%80%D0%B8%D1%87%D0%B8%D0%BD%D1%8B_%D0%BF%D0%BE%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B8_%D0%BD%D0%B0_%D1%83%D1%87%D1%91%D1%82_(%D0%9A%D0%9F%D0%9F)
 */
class KppValidator extends AbstractValidator
{
    /**
     * Validates KPP
     *
     * @inheritDoc
     */
    public function validate(mixed $value): bool
    {
        if (!is_scalar($value)) {
            return $this->endOnInvalid();
        }

        $value = $this->stringify($value);

        if (!preg_match('/^\d{4}[\dA-Za-z]{2}\d{3}$/', $value)) {
            return $this->endOnInvalid();
        }

        return true;
    }
}
