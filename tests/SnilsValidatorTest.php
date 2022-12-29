<?php

declare(strict_types=1);

namespace LTS\RussianValidators\Tests;

use LTS\RussianValidators\SnilsValidator;

class SnilsValidatorTest extends AbstractGeneralValidatorTest
{
    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$validator = new SnilsValidator();
    }

    /**
     * @inheritDoc
     */
    protected function validDataProvider(): array
    {
        return [
            ['888-852-416 91'],
            ['558 590 823 45'],
            ['101_413_304 70'],
            ['233*474*454*63'],
            ['469+134+730-09'],
            ['888-647-988_24'],
            ['24769790639'],
            ['34832293083'],
            ['48049045999'],
            ['70107180638'],
            ['42760701773'],
            ['16528629798'],
            ['96315642524'],
            ['74294619329'],
            ['13624029333'],
            ['28245208674'],
            ['46191443386'],
            ['71702152961'],
            ['40214582124'],
            ['02563045528'],
            ['28057052570'],
            ['43470468281'],
            ['53293915100'],
            ['11431526813'],
            ['04628129255'],
            ['31972101661'],
            ['16665308996'],
            ['99771756102'],
            ['36188763828'],
            ['79969017902'],
            ['14790233470'],
            ['63479844245'],
            ['15429516169'],
            ['38647614732'],
            ['22808426669'],
            ['74843369743'],
            ['55059469111'],
            ['61158927599'],
            ['43445748092'],
            ['98982072594'],
            ['54793192331'],
            ['92081053373'],
            ['43673181997'],
            ['57490373727'],
            ['12726817872'],
            ['98168901064'],
            ['90221062134'],
            ['61982804627'],
            ['04326635037'],
            ['91653364820'],
            ['98015595738'],
            ['61211830936'],
            ['92372102077'],
            ['93849867698'],
            ['71551307066'],
            ['60381553977'],
            ['24541355050'],
            ['77403561808'],
            ['07619129682'],
            ['84357118718'],
            ['33270473049'],
            ['91103177352'],
            ['86806909866'],
            ['76808535448'],
            ['71068660795'],
            ['32560131129'],
            ['41670042851'],
            ['97581312042'],
            ['55492116398'],
            ['11265008613'],
            ['36990735542'],
            ['71514987408'],
            ['01692687681'],
            ['12456413239'],
            ['27349023479'],
            ['45047702369'],
            ['42980615503'],
            ['81489644043'],
            ['33501898267'],
            ['89071540526'],
            ['52508928901'],
            ['39184069917'],
            ['89611018014'],
            ['89094190552'],
            ['41746537998'],
            ['13742204637'],
            ['31040990627'],
            ['17681863923'],
            ['91290659214'],
            ['99873330994'],
            ['16794076415'],
            ['44998438973'],
            ['45917787246'],
            ['24959686046'],
            ['45354798319'],
            ['08032171422'],
            ['94234056192'],
            ['50626735580'],
            ['40768481405'],
            ['36109098372'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function invalidDataProvider(): array
    {
        return [
            'JUST_INVALID'   => ['51192312347'],
            'ONE_CHAR_ERROR' => ['24769790638'],
        ];
    }
}