<?php

namespace LTS\RussianValidators;

/**
 * Class for validate BIK
 *
 * @link https://www.consultant.ru/document/cons_doc_LAW_367694/fa4fb7b68518112d6b37e77c1b0bb56b6cca42eb/
 */
class BikValidator extends AbstractValidator
{
    /**
     * BIK correct length
     */
    public const CORRECT_LENGTH = 9;

    /**
     * BIK allowed first number digits
     *
     * @link https://www.consultant.ru/document/cons_doc_LAW_367694/fa4fb7b68518112d6b37e77c1b0bb56b6cca42eb/
     */
    public const ALLOWED_FIRST_DIGITS = [0, 1, 2];

    /**
     * @inheritDoc
     */
    public function validate(mixed $value): bool
    {
        if (!is_scalar($value)) {
            return $this->endOnInvalid();
        }

        $value = $this->stringify($value);

        /**
         * BIK must be 9-digit number
         */
        if (!preg_match('/^\d{' . self::CORRECT_LENGTH . '}$/', $value)) {
            return $this->endOnInvalid();
        }

        /**
         * BIK cannot be X00000000, it's 2-9 digits must be 00000001-99999999
         */
        if (preg_match('/^\d0{' . self::CORRECT_LENGTH - 1 . '}$/', $value)) {
            return $this->endOnInvalid();
        }

        /**
         * BIK's allowed first digits are: '0', '1', '2'
         */
        if (!in_array($value[0], self::ALLOWED_FIRST_DIGITS)) {
            return $this->endOnInvalid();
        }

        return true;
    }
}
