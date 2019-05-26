<?php

namespace App\Tests;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    public function providerValidNumber(): array
    {
        return [
            ['2.84M', '2835779'],
            ['1.00M', '999500'],
            ['535K', 535216],
            ['100K', 99950],
            ['27 534', 27533.78],
            ['1 000', 999.9999],
            ['999.99', 999.99],
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12.00',12],
            ['-2.84M', -2835779],
            ['-1.00M', -999500],
            ['-535K', -535216],
            ['-100K', -99950],
            ['-27 534', -27533.78],
            ['-1 000', -999.9999],
            ['-999.99', -999.99],
            ['-533.10', -533.1],
            ['-66.67', -66.6666],
            ['-12.00', -12]
        ];
    }

    /**
     * @dataProvider providerValidNumber
     * @param string $expectedNumber
     * @param int    $actualNumber
     */
    public function testValidNumber($expectedNumber, $actualNumber)
    {
        $numbers = new NumberFormatter();
        $this->assertEquals($expectedNumber, $numbers->numberFormatter($actualNumber));
    }
}
