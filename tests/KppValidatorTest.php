<?php

declare(strict_types=1);

namespace LTS\RussianValidators\Tests;

use LTS\RussianValidators\KppValidator;

class KppValidatorTest extends AbstractGeneralValidatorTest
{
    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$validator = new KppValidator();
    }

    /**
     * @inheritDoc
     */
    protected function validDataProvider(): array
    {
        return [
            ['265531413'],
            ['504932940'],
            ['419134471'],
            ['1026AS063'],
            ['255103655'],
            ['105228016'],
            ['780322538'],
            ['565736230'],
            ['455713737'],
            ['5415XC800'],
            ['211618273'],
            ['496436996'],
            ['768012432'],
            ['999141616'],
            ['7412FN663'],
            ['609328127'],
            ['611035771'],
            ['998527579'],
            ['398514917'],
            ['308515021'],
            ['581426579'],
            ['119618368'],
            ['211619836'],
            ['379814209'],
            ['184148005'],
            ['285506172'],
            ['7904ZV336'],
            ['098424036'],
            ['646724872'],
            ['912410251'],
            ['688128239'],
            ['576943537'],
            ['454507645'],
            ['171410141'],
            ['431530153'],
            ['922730429'],
            ['590610485'],
            ['861417627'],
            ['271238999'],
            ['607934702'],
            ['121225780'],
            ['423341999'],
            ['683007373'],
            ['584022891'],
            ['228702919'],
            ['317631350'],
            ['390226409'],
            ['296327099'],
            ['544243349'],
            ['057134677'],
            ['4496QW928'],
            ['177417477'],
            ['778841182'],
            ['510935481'],
            ['393012278'],
            ['202814785'],
            ['646026471'],
            ['555032492'],
            ['524620488'],
            ['330942482'],
            ['695501056'],
            ['541010068'],
            ['524403609'],
            ['225803362'],
            ['153801197'],
            ['340320848'],
            ['495237924'],
            ['121534281'],
            ['617607776'],
            ['4204YH614'],
            ['685741439'],
            ['062920103'],
            ['085801804'],
            ['053629686'],
            ['354140283'],
            ['402937170'],
            ['396025646'],
            ['8631am623'],
            ['661909795'],
            ['205710747'],
            ['058243113'],
            ['9999up062'],
            ['291037100'],
            ['3353VW201'],
            ['231840569'],
            ['290735460'],
            ['7158yM078'],
            ['491907327'],
            ['586734490'],
            ['4294Ht245'],
            ['631624873'],
            ['735033623'],
            ['121650347'],
            ['0550Eb072'],
            ['316819869'],
            ['471417757'],
            ['657218896'],
            ['1025me904'],
            ['316139861'],
            ['484120767'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function invalidDataProvider(): array
    {
        return [
            'FIRST_SYMBOL_IS_LETTER'  => ['Q206AA032'],
            'ALL_SYMBOLS_ARE_LETTERS' => ['QCFEAADGG'],
            'ONE_CHAR_LONGER'         => ['2655314131'],
            'TOO_LONG'                => ['5156563538885'],
            'ONE_CHAR_SHORTER'        => ['26553141'],
            'TOO_SHORT'               => ['10736'],
            'CORRECT_INN'             => ['1927566091'],
            'CORRECT_SNILS'           => ['24769790639'],
            'CORRECT_OGRN'            => ['7053274436703'],
            'CORRECT_OGRNIP'          => ['415557944280841'],
            'RANDOM_SYMBOLS'          => ['_dm$7UDr'],
        ];
    }
}
