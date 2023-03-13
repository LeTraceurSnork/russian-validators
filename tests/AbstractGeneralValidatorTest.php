<?php

declare(strict_types=1);

namespace LTS\RussianValidators\Tests;

use LTS\RussianValidators\AbstractValidator;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class that sets general invalid data sets
 */
abstract class AbstractGeneralValidatorTest extends TestCase
{
    /**
     * Validator of corresponding type
     *
     * @var AbstractValidator
     */
    protected static AbstractValidator $validator;

    /**
     * @dataProvider validDataProvider
     *
     * @param mixed $value
     *
     * @return void
     */
    public function testValid(mixed $value): void
    {
        $this->assertTrue(self::$validator->validate($value));
    }

    /**
     * @dataProvider notIdentifiersDataProvider
     * @dataProvider zerosDataProvider
     * @dataProvider invalidDataProvider
     *
     * @param mixed $value
     *
     * @return void
     */
    public function testInvalid(mixed $value): void
    {
        $this->assertFalse(self::$validator->validate($value));
    }

    /**
     * Returns an array of valid identifiers for corresponding validator
     *
     * @return array
     */
    abstract protected function validDataProvider(): array;

    /**
     * Returns an array of invalid identifiers for corresponding validator
     *
     * @return string[]
     */
    abstract protected function invalidDataProvider(): array;

    /**
     * @return array{test_name: string, value_array: array{value: mixed}}
     */
    protected function notIdentifiersDataProvider(): array
    {
        return [
            'NULL'                             => [null],
            'OBJECT'                           => [new stdClass()],
            'EMPTY_STRING'                     => [''],
            'CORRECT_NUMBER_OF_SYMBOLS_TEN'    => ['-+*/[{()}]'],
            'CORRECT_NUMBER_OF_SYMBOLS_TWELVE' => ['-+*/[{()}]_?'],
        ];
    }

    /**
     * @return array{test_name: string, value_array: array{value: mixed}}
     */
    protected function zerosDataProvider(): array
    {
        return [
            'ZERO'       => [0],
            'ZERO_FLOAT' => [0.0],
        ];
    }
}
