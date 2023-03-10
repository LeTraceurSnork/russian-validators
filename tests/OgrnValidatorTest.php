<?php

declare(strict_types=1);

namespace LTS\RussianValidators\Tests;

use LTS\RussianValidators\OgrnValidator;

/**
 * @coversDefaultClass \LTS\RussianValidators\OgrnValidator
 */
class OgrnValidatorTest extends AbstractGeneralValidatorTest
{
    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$validator = new OgrnValidator();
    }

    /**
     * @inheritDoc
     */
    protected function validDataProvider(): array
    {
        return [
            ['8153185663282'],
            ['7053274436703'],
            ['1147108643483'],
            ['9022627896018'],
            ['9127170108518'],
            ['6167171512711'],
            ['7165449772668'],
            ['2081842066546'],
            ['8140510568300'],
            ['6161229653667'],
            ['6213651618141'],
            ['8097667305190'],
            ['5075291637120'],
            ['5214933928985'],
            ['6154138047850'],
            ['5111281585762'],
            ['2127497841931'],
            ['2157837769880'],
            ['9222554415943'],
            ['9052130770804'],
            ['7114950479175'],
            ['9146719613449'],
            ['7173279922622'],
            ['5057567259580'],
            ['6131290060885'],
            ['9187959448756'],
            ['9121853004540'],
            ['7119946158270'],
            ['8196603867353'],
            ['7147103350805'],
            ['5127854018529'],
            ['9062311471191'],
            ['9218664345748'],
            ['7096393024149'],
            ['9122656974497'],
            ['7222914334867'],
            ['6062605294922'],
            ['1193467261195'],
            ['1100259139826'],
            ['7020266334213'],
            ['8082855304249'],
            ['6082503412546'],
            ['8145060152262'],
            ['8060224975407'],
            ['9168743241108'],
            ['7055088416288'],
            ['6051868605728'],
            ['9033255038973'],
            ['1226111215032'],
            ['8044090472473'],
            ['6101736256418'],
            ['8105194544425'],
            ['2060693966298'],
            ['9075257500815'],
            ['5161027674088'],
            ['1061741943405'],
            ['9131122520047'],
            ['8120462449792'],
            ['2060678419052'],
            ['5087126879571'],
            ['1175575186984'],
            ['8183299257595'],
            ['5051625221170'],
            ['2140880711684'],
            ['2030341463140'],
            ['9125110188689'],
            ['8045585522590'],
            ['5166829289644'],
            ['2193370045988'],
            ['6107020067071'],
            ['8164473603550'],
            ['9062149532007'],
            ['8204135395049'],
            ['6130931873330'],
            ['1082977389714'],
            ['5025807645540'],
            ['6106852562680'],
            ['1124852892130'],
            ['2137029063070'],
            ['8145005365211'],
            ['2216319356515'],
            ['6211209283917'],
            ['8034859238813'],
            ['5080209951355'],
            ['2116252831814'],
            ['8096984737721'],
            ['9066452193865'],
            ['7022025476521'],
            ['2150408489031'],
            ['1117020741947'],
            ['1217086943040'],
            ['8051083636948'],
            ['7043799463173'],
            ['1065810755207'],
            ['1196629050947'],
            ['1119178970646'],
            ['2106766125079'],
            ['2162130029048'],
            ['2147540000210'],
            ['2121656652808'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function invalidDataProvider(): array
    {
        return [
            ['2166148376963'],
            ['0909090800002'],
            ['0909090900003'],
            ['0123456789104'],
            ['0657187958042'],
            ['0987654321005'],
            ['8253185663282'],
            ['7153274436703'],
            ['1547108643483'],
            ['9622627896018'],
            ['9327170108518'],
        ];
    }
}
