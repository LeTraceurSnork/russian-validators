<?php

declare(strict_types=1);

namespace LTS\RussianValidators\Tests;

use LTS\RussianValidators\OgrnipValidator;

/**
 * @coversDefaultClass \LTS\RussianValidators\OgrnipValidator
 */
class OgrnipValidatorTest extends AbstractGeneralValidatorTest
{
    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$validator = new OgrnipValidator();
    }

    /**
     * @inheritDoc
     */
    protected function validDataProvider(): array
    {
        return [
            ['417620480778249'],
            ['412436337808812'],
            ['411253597285031'],
            ['403659072453088'],
            ['403717390049082'],
            ['409275970590760'],
            ['421774132000694'],
            ['410713211941577'],
            ['419997612118622'],
            ['408695109554542'],
            ['411150539079064'],
            ['321585006091432'],
            ['405919804181093'],
            ['321155555649210'],
            ['313381808838662'],
            ['312794908571157'],
            ['317753780478248'],
            ['409642420730411'],
            ['310201244104235'],
            ['314446688126015'],
            ['403388193419792'],
            ['420717185622132'],
            ['406642069916412'],
            ['317696521315389'],
            ['408641712480637'],
            ['415141419002625'],
            ['306264673955511'],
            ['304229627119982'],
            ['407598281427914'],
            ['403083626096679'],
            ['408746522306441'],
            ['410255819579029'],
            ['312014309405209'],
            ['417241723232081'],
            ['309695056816462'],
            ['302282387898466'],
            ['405929889651750'],
            ['414737300928796'],
            ['407573301829980'],
            ['318521979426660'],
            ['312279055943270'],
            ['314333033438580'],
            ['304186877849823'],
            ['408551643238971'],
            ['322070537439452'],
            ['315461580343304'],
            ['317699512439942'],
            ['407371586819926'],
            ['312669862282570'],
            ['412523300940630'],
            ['316440479016579'],
            ['322011944638250'],
            ['421700606259314'],
            ['316424829306247'],
            ['406341660624089'],
            ['319071610398201'],
            ['315083073213101'],
            ['422796869289569'],
            ['402207824355297'],
            ['311236286477546'],
            ['409671935433866'],
            ['411416603054592'],
            ['322477341480029'],
            ['304471953572769'],
            ['407396759824287'],
            ['411283136113277'],
            ['414701693319661'],
            ['416318385627552'],
            ['311547711731330'],
            ['415400289222980'],
            ['412232169873680'],
            ['307029354822201'],
            ['322531931422189'],
            ['304050247371390'],
            ['319016177103879'],
            ['308697643572511'],
            ['420341008584023'],
            ['412027773761447'],
            ['410552853401373'],
            ['405110245275561'],
            ['313732440974000'],
            ['414159923931661'],
            ['307165141595088'],
            ['412263968664027'],
            ['304175487185279'],
            ['417734189360194'],
            ['410525127028814'],
            ['408732925348086'],
            ['411673154737802'],
            ['312472130332279'],
            ['312753921630119'],
            ['322780222537611'],
            ['321413740056511'],
            ['410121033260067'],
            ['306327311010209'],
            ['415223635909215'],
            ['414044131244372'],
            ['318339658383599'],
            ['406125654417893'],
            ['415557944280841'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function invalidDataProvider(): array
    {
        return [
            'LAST_DIGIT_ONE_HIGHER'                   => ['417620480778248'],
            'LAST_DIGIT_ONE_LOWER'                    => ['412436337808813'],
            'INVALID_LENGTH'                          => ['41125359728501'],
            'CONTAINS_LETTERS'                        => ['40365907245308X'],
            'LAST_DIGIT_INVALID'                      => ['403717390049080'],
            'STARTS_WITH_ZERO'                        => ['009275970590760'],
            'STARTS_WITH_ONE'                         => ['102275970590760'],
            'STARTS_WITH_ONE_BUT_CHECKSUM_IS_CORRECT' => ['121774132000690'],
            'TOO_SHORT'                               => ['410713277'],
            'TOO_LONG'                                => ['9127170108512312318'],
        ];
    }
}
