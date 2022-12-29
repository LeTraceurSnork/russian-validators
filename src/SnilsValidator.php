<?php

declare(strict_types=1);

namespace LTS\RussianValidators;

/**
 * Class for validate SNILS (Russian social security number)
 *
 * @link https://ru.wikipedia.org/wiki/%D0%9A%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BD%D0%BE%D0%B5_%D1%87%D0%B8%D1%81%D0%BB%D0%BE#%D0%A1%D1%82%D1%80%D0%B0%D1%85%D0%BE%D0%B2%D0%BE%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80_%D0%B8%D0%BD%D0%B4%D0%B8%D0%B2%D0%B8%D0%B4%D1%83%D0%B0%D0%BB%D1%8C%D0%BD%D0%BE%D0%B3%D0%BE_%D0%BB%D0%B8%D1%86%D0%B5%D0%B2%D0%BE%D0%B3%D0%BE_%D1%81%D1%87%D1%91%D1%82%D0%B0_(%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F)
 */
class SnilsValidator extends AbstractValidator
{
    /**
     * SNILS length
     */
    private const CORRECT_LENGTH = 11;

    /**
     * Checksum multipliers of corresponding INN digits for selected check number position
     */
    private const CHECKSUM_MULTIPLIERS = [9, 8, 7, 6, 5, 4, 3, 2, 1];

    /**
     * Validates SNILS
     *
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

        if (!$this->validateCheckNumber($value)) {
            return $this->endOnInvalid();
        }

        return true;
    }

    /**
     * Checks if last two digits is a correct SNILS checksum
     *
     * @param string $value
     *
     * @return bool
     */
    private function validateCheckNumber(string $value): bool
    {
        $digits            = str_split($value);
        $chunked_digits    = array_chunk($digits, self::CORRECT_LENGTH - 2);
        $identifier_digits = $chunked_digits[0]; // First 9 digits of SNILS is identifier itself, last 2 is checksum

        $calculated_checksum = 0;
        foreach ($identifier_digits as $key => $digit) {
            $calculated_checksum += $digit * self::CHECKSUM_MULTIPLIERS[$key];
        }

        $calculated_checknumber = $calculated_checksum % 101 % 100;

        /**
         * Checking that last two digits matches the formula
         */
        $actual_checksum = $digits[self::CORRECT_LENGTH - 1] + $digits[self::CORRECT_LENGTH - 2] * 10;

        return $calculated_checknumber === $actual_checksum;
    }
}
