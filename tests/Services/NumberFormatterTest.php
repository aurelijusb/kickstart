<?php

namespace App\Services\Tests;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

/**
 * Class NumberFormatterTest
 * @package App\Services\Tests
 */
class NumberFormatterTest extends TestCase
{

    private $numberFormatter = null;

    public function setUp() :void{
        $this->numberFormatter = new NumberFormatter();
    }

    /**
     * @return array
     */
    public function providerMillions() :array
    {
        return [
            'Positive'              => ['2.84M', 2835779],
            'Negative'              => ['-2.84M', -2835779],
            'Edge case Positive'    => ['1.00M', 999500],
            'Edge case Negative'    => ['-1.00M', -999500]
        ];
    }

    /**
     * @return array
     */
    public function providerThousands() :array
    {
        return [
            'Positive'              => ['535K', 535216],
            'Negative'              => ['-535K', -535216],
            'Edge case Positive'    => ['100K', 99950],
            'Edge case Negative'    => ['-100K', -99950],
            'Positive with decimal' => ['124K', 123654.89],
            'Negative with decimal' => ['-124K', -123654.89]
        ];
    }

    /**
     * @return array
     */
    public function providerHundreds() :array
    {
        return [
            'Edge case Positive'    => ['999.99', 999.99],
            'Edge case Negative'    => ['-999.99', -999.99],
            'Exception Positive'    => ['1 000', 999.9999],
            'Exception Negative'    => ['-1 000', -999.9999],
            'Positive with decimal' => ['27 534', 27533.78],
            'Negative with decimal' => ['-27 534', -27533.78],
            'Other Positive'        => ['533.10', 533.1],
            'Other Negative'        => ['-533.10', -533.1]
        ];
    }

    /**
     * @return array
     */
    public function providerTenths() :array
    {
        return [
            'Positive'       => ['66.67', 66.6666],
            'Negative'       => ['-66.67', -66.6666],
            'Other'        => ['55.00', 55],
            'Zero'           => ['0.00', 0]
        ];
    }

    /**
     * @dataProvider providerMillions
     * @param string $expectedFormat
     * @param float $numb
     */
    public function testMillionsFormatting(string $expectedFormat, float $numb)
    {
        $this->assertEquals($expectedFormat,$this->numberFormatter->formatNumber($numb));
    }

    /**
     * @dataProvider providerThousands
     * @param string $expectedFormat
     * @param float $numb
     */
    public function testThousandsFormatting(string $expectedFormat, float $numb)
    {
        $this->assertEquals($expectedFormat,$this->numberFormatter->formatNumber($numb));
    }

    /**
     * @dataProvider providerHundreds
     * @param string $expectedFormat
     * @param float $numb
     */
    public function testHundredsFormatting(string $expectedFormat, float $numb)
    {
        $this->assertEquals($expectedFormat,$this->numberFormatter->formatNumber($numb));
    }

    /**
     * @dataProvider providerTenths
     * @param string $expectedFormat
     * @param float $numb
     */
    public function testTenthsFormatting(string $expectedFormat, float $numb)
    {
        $this->assertEquals($expectedFormat,$this->numberFormatter->formatNumber($numb));
    }
}
