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
     *
     */
    private const CLEARING_CURRENCY_CODES = [
        'A' => 0,
        'B' => 1,
        'C' => 2,
        'E' => 3,
        'H' => 4,
        'K' => 5,
        'M' => 6,
        'P' => 7,
        'T' => 8,
        'X' => 9,
    ];

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
        $value = $this->resolveClearingCurrencyCode($value);

        /**
         * KS must be 20-digit number
         */
        if (!preg_match('/^\d{' . self::CORRECT_LENGTH . '}$/', $value)) {
            return $this->endOnInvalid();
        }

        if (!isset($this->bik)) {
            return true;
        }

        if (!$this->validateControlKey($value, $this->bik)) {
            return $this->endOnInvalid();
        }

        return true;
    }

    /**
     * @link https://normativ.kontur.ru/document?moduleId=1&documentId=24444
     *
     * @param string $bik
     * @param string $ks
     *
     * @return bool
     */
    private function validateControlKey(string $ks, string $bik): bool
    {
        $rkc_num            = sprintf('0%1$s%2$s', $bik[4], $bik[5]);
        $ks_with_rkc_digits = str_split($rkc_num . $ks);

        $control_key = 0;
        foreach ($ks_with_rkc_digits as $key => $digit) {
            $control_key += $digit * self::CONTROL_KEY_MULTIPLIERS[$key] % 10;
        }

        return $control_key % 10 === 0;
    }

    /**
     * Resolves KS 6 digit if it has a valid letter
     *
     * @param string $value
     *
     * @return string
     */
    private function resolveClearingCurrencyCode(string $value): string
    {
    }
}
