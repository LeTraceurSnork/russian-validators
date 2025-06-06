<?php

declare(strict_types=1);

namespace LTS\RussianValidators;

/**
 * Class for validate GRZ (Vehicle Registration Plate (гос. регистрационный знак))
 *
 * @link https://ru.wikipedia.org/wiki/%D0%A0%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B5_%D0%B7%D0%BD%D0%B0%D0%BA%D0%B8_%D1%82%D1%80%D0%B0%D0%BD%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%BD%D1%8B%D1%85_%D1%81%D1%80%D0%B5%D0%B4%D1%81%D1%82%D0%B2_%D0%B2_%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B8
 */
class GrzValidator extends AbstractValidator
{
    /**
     * These characters are valid as a part of russian vehicle plate since they appear in both cyrrilic and latin
     * alphabets
     *
     * @see https://docs.cntd.ru/document/1200160380
     */
    public const VALID_LATIN_CHARACTERS = ['A', 'B', 'E', 'K', 'M', 'H', 'O', 'P', 'C', 'T', 'Y', 'X'];

    /**
     * These characters are valid as a part of russian vehicle plate since they appear in both cyrrilic and latin
     * alphabets
     *
     * @see https://docs.cntd.ru/document/1200160380
     */
    public const VALID_CYRILLIC_CHARACTERS = ['А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х'];

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): bool
    {
        if (!is_scalar($value)) {
            return $this->endOnInvalid();
        }

        $value = $this->stringify($value);

        $latin_characters    = implode('', static::VALID_LATIN_CHARACTERS);
        $cyrillic_characters = implode('', static::VALID_CYRILLIC_CHARACTERS);
        $valid_letters       = $latin_characters . $cyrillic_characters;

        switch (true) {
            /**
             * Group #1, type #1 + #1A
             */
            case preg_match(
                sprintf('/^[%1$s]{1}(\d{3})[%1$s]{2}(\d{2,3}(RUS?)?)?$/u', $valid_letters),
                $value,
                $matches
            ):
                /**
                 * Group #1, type #1B
                 */
            case preg_match(
                sprintf('/^[%1$s]{2}(\d{3})(\d{2,3}(RUS?)?)?$/u', $valid_letters),
                $value,
                $matches
            ):
                /**
                 * Group #1, type #2 + 4A
                 */
            case preg_match(
                sprintf('/^[%1$s]{2}(\d{4})(\d{2,3}(RUS?)?)?$/u', $valid_letters),
                $value,
                $matches
            ):
                /**
                 * Group #1, type #3 + #4
                 */
            case preg_match(
                sprintf('/^(\d{4})[%1$s]{2}(\d{2,3}(RUS?)?)?$/u', $valid_letters),
                $value,
                $matches
            ):
                /**
                 * Group #1, type #4B
                 */
            case preg_match(
                sprintf('/^[%1$s]{2}(\d{2})[%1$s]{2}(\d{2,3}(RUS?)?)?$/u', $valid_letters),
                $value,
                $matches
            ):
                return $matches[1] !== '00' || $this->endOnInvalid();

            default:
                return $this->endOnInvalid();
        }

        //        // Проверяем диапазон чисел 01-99 или 100-999
        //        $number = (int)substr($value, 4, -3); // Извлекаем число из шаблона
        //        if (($number >= 1 && $number <= 99) || ($number >= 100 && $number <= 999)) {
        //            return true;
        //        }

        return $this->endOnInvalid();
    }
}
