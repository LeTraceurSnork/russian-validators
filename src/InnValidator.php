<?php

declare(strict_types=1);

namespace LTS\RussianValidators;

/**
 * Class for validate INN (russian VAT analogue)
 *
 * @link https://ru.wikipedia.org/wiki/%D0%98%D0%B4%D0%B5%D0%BD%D1%82%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80_%D0%BD%D0%B0%D0%BB%D0%BE%D0%B3%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D1%89%D0%B8%D0%BA%D0%B0#%D0%92%D1%8B%D1%87%D0%B8%D1%81%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5_%D0%BA%D0%BE%D0%BD%D1%82%D1%80%D0%BE%D0%BB%D1%8C%D0%BD%D1%8B%D1%85_%D1%86%D0%B8%D1%84%D1%80
 */
class InnValidator extends AbstractValidator
{
    /**
     * Checksum multipliers of corresponding INN digits for selected check number position
     */
    private const CHECKSUM_MULTIPLIERS = [
        10 => [2, 4, 10, 3, 5, 9, 4, 6, 8],
        11 => [7, 2, 4, 10, 3, 5, 9, 4, 6, 8],
        12 => [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8],
    ];

    /**
     * Validates INN
     *
     * @inheritDoc
     */
    public function validate(mixed $value): bool
    {
        if (!is_scalar($value)) {
            return $this->endOnInvalid();
        }

        $value = $this->stringify($value);

        if (!preg_match('/^(\d{10}|\d{12})$/', $value)) {
            return $this->endOnInvalid();
        }

        if (strlen($value) === 10) {
            return $this->validateCheckNumber($value, 10) || $this->endOnInvalid();
        }

        if (!$this->validateCheckNumber($value, 11) || !$this->validateCheckNumber($value, 12)) {
            return $this->endOnInvalid();
        }

        return true;
    }

    /**
     * Checks if a digit on specified $position is a correct checksum number
     *
     * @param string $value
     * @param int    $position
     *
     * @return bool
     */
    private function validateCheckNumber(string $value, int $position): bool
    {
        $digits              = str_split($value);
        $checksum_calculated = 0;
        foreach (self::CHECKSUM_MULTIPLIERS[$position] as $multiplier_position => $multiplier) {
            $checksum_calculated += $digits[$multiplier_position] * $multiplier;
        }

        $check_number_calculated = ($checksum_calculated % 11) % 10;
        $checksum_actual         = (int)$digits[$position - 1]; // 'Cause numeration starts from 0

        return $check_number_calculated === $checksum_actual;
    }
}
