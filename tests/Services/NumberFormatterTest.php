<?php

namespace App\Tests\Services;

use App\Services\NumberFormater;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    public function numbersProvider() {

        return [
            ['2.84M', 2835779],
            ['1.00M', 999500],
            ['535K', 535216],
            ['100K', 99950],
            ['27 534', 27533.78],
            ['999.99', 999.99],
            ['1 000', 999.9999],
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12', 12],
            ['-2.84M', -2835779],
            ['-1.00M', -999500],
            ['-535K', -535216],
            ['-100K', -99950],
            ['-27 534', -27533.78],
            ['-999.99', -999.99],
            ['-1 000', -999.9999],
            ['-533.10', -533.1],
            ['-66.67', -66.6666],
            ['-12', -12],
        ];
    }
    /**
     * @NumberFormaterTest
     * @dataProvider numbersProvider
     */
    public function testFormatCurrency($output, $input)
    {
        $numberFormater = new NumberFormater($output, $input);
        $this->assertEquals($output, $numberFormater->formatNumber($input));
    }
}