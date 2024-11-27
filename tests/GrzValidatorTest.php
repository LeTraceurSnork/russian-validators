<?php

declare(strict_types=1);

namespace LTS\RussianValidators\Tests;

use LTS\RussianValidators\GrzValidator;

/**
 * @coversDefaultClass \LTS\RussianValidators\BikValidator
 */
class GrzValidatorTest extends AbstractGeneralValidatorTest
{
    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$validator = new GrzValidator();
    }

    /**
     * @inheritDoc
     */
    protected function validDataProvider(): array
    {
        return [
            'GROUP#1 TYPE #1+#1A' => [
                'A001AA',
                'E777KX',
                'M555MM',
                'M900CB',
                'A763EE',
                'K902OM',
            ],
            'GROUP#1 TYPE #1B'    => ['KB013'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function invalidDataProvider(): array
    {
        return [
            'ONLY_DIGITS'          => ['100023'],
            'ALL_ZEROS'            => ['A000AA'],
            'HAS_INCORRECT_LETTER' => ['J001AA'],
            'STRING'               => ['ABCDEFGHIJ'],
            'CORRECT_INN'          => ['1927566091'],
            'CORRECT_SNILS'        => ['24769790639'],
            'CORRECT_OGRN'         => ['7053274436703'],
            'CORRECT_OGRNIP'       => ['415557944280841'],
        ];
    }
}
