<?php

namespace App\Formatter;


class MoneyFormatter
{
    private $numberFormatter;

    public function __construct(NumberFormatter $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }


    public function formatEur( float $number = 0 )
    {
        $numberAsString = $this->numberFormatter->floatToString($number);
        $result = $numberAsString . ' €'; 
        return $result;
    }

    public function formatUsd( float $number = 0 )
    {
        $numberAsString = $this->numberFormatter->floatToString($number);
        $result = '$' . $numberAsString;
        return $result;
    }
}