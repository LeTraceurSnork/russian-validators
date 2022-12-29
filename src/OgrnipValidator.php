<?php

declare(strict_types=1);

namespace LTS\RussianValidators;

/**
 * Class for validate OGRNIP (Russian LEI analogue)
 *
 * @link https://ru.wikipedia.org/wiki/%D0%9E%D1%81%D0%BD%D0%BE%D0%B2%D0%BD%D0%BE%D0%B9_%D0%B3%D0%BE%D1%81%D1%83%D0%B4%D0%B0%D1%80%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D1%8B%D0%B9_%D1%80%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80_%D0%B8%D0%BD%D0%B4%D0%B8%D0%B2%D0%B8%D0%B4%D1%83%D0%B0%D0%BB%D1%8C%D0%BD%D0%BE%D0%B3%D0%BE_%D0%BF%D1%80%D0%B5%D0%B4%D0%BF%D1%80%D0%B8%D0%BD%D0%B8%D0%BC%D0%B0%D1%82%D0%B5%D0%BB%D1%8F
 */
class OgrnipValidator extends AbstractValidator
{
    /**
     * OGRNIP checknumber is [first <CORRECT_OGRNIP_LENGTH-1> digits] mod this
     */
    public const CHECKNUMBER_DIVISOR = 13;

    /**
     * OGRNIP correct length
     */
    public const CORRECT_LENGTH = 15;

    /**
     * OGRNIP allowed first number digits
     *
     * @link http://publication.pravo.gov.ru/Document/View/0001201801170015?index=4&rangeSize=1
     */
    public const ALLOWED_FIRST_DIGITS = [3, 4];

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): bool
    {
        if (!is_scalar($value)) {
            return $this->endOnInvalid();
        }

        $value = $this->stringify($value);

        if (!preg_match('/^\d{' . self::CORRECT_LENGTH . '}$/', $value)) {
            return $this->endOnInvalid();
        }

        /**
         * OGRNIP can only have '3' or '4' as its first digit
         *
         * @link http://publication.pravo.gov.ru/Document/View/0001201801170015?index=4&rangeSize=1
         */
        if (!in_array($value[0], self::ALLOWED_FIRST_DIGITS)) {
            return false;
        }

        if (!$this->validateCheckNumber($value)) {
            return $this->endOnInvalid();
        }

        return true;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    private function validateCheckNumber(string $value): bool
    {
        $digits                 = str_split($value);
        $checknumber            = array_pop($digits);
        $calculated_checknumber = bcmod(implode('', $digits), (string)self::CHECKNUMBER_DIVISOR) % 10;

        return (int)$checknumber === $calculated_checknumber;
    }
}
