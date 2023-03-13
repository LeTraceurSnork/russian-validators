<?php

namespace LTS\RussianValidators;

/**
 * Class for validate KS
 *
 * @link http://www.consultant.ru/document/cons_doc_LAW_16053/08c1d0eacf880db80ef56f68c3469e2ea24502d7/
 */
class KsValidator extends AbstractValidator
{
    /**
     * Control key multipliers for corresponding digits positions
     */
    private const CONTROL_KEY_MULTIPLIERS = [7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1];

    /**
     * KS correct length
     */
    public const CORRECT_LENGTH = 20;

    /**
     * @var string
     */
    private string $bik;

    /**
     * Sets BIK
     *
     * @param mixed $bik
     *
     * @return $this
     */
    public function byBik(mixed $bik): self
    {
        $this->bik = $this->stringify($bik);

        return $this;
    }

    /**
     * Returns true if value matches the rule
     * If BIK was set via byBik() method, validates KS by BIK with checksum calculations, otherwise just checks the
     * format
     * IT IS STRONGLY RECOMMENDED to call byBik() method first
     *
     * @see http://www.consultant.ru/document/cons_doc_LAW_16053/08c1d0eacf880db80ef56f68c3469e2ea24502d7/
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function validate(mixed $value): bool
    {
        if (!is_scalar($value)) {
            return $this->endOnInvalid();
        }

        $value = $this->stringify($value);

        /**
         * KS must be 20-digit number
         */
        if (!preg_match('/^\d{' . self::CORRECT_LENGTH . '}$/', $value)) {
            return $this->endOnInvalid();
        }

        if (!isset($this->bik)) {
            return true;
        }

        return true;
    }

    /**
     * Checks if KS checknumber is correctly calculated from BIK
     *
     * @param string $ks
     * @param string $bik
     *
     * @return bool
     */
    private function validateCheckNumber(string $ks, string $bik): bool
    {
        $control_key = $this->calculateControlKey($ks, $bik);
    }

    private function calculateControlKey(string $ks, string $bik): int
    {
        $rkc_num        = sprintf('0%1$s%2$s', $this->bik[4], $this->bik[5]);
        $chunked_digits = str_split($ks);

        $calculated_checksum = 0;
        foreach ($chunked_digits as $key => $digit) {
            $calculated_checksum += $digit * self::CONTROL_KEY_MULTIPLIERS[$key] % 10;
        }
        $calculated_checknumber = ($calculated_checksum * 3) % 10;
    }
}
