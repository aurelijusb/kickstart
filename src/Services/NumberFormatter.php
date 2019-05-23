<?php


namespace App\Services;


class NumberFormatter
{
    public function formatCurrency(float $number): string
    {
        switch ($number) {
            case (round($number,0) === 0):
                return '0';
            case (($number >= 999500 || $number <= -999500)):
                echo $number . '<br>' ;
                return number_format($number/1000000, 2) . 'M';
            case ($number >= 99950 && $number <= 999500) || ($number <= -99950 && $number >= -999500):
                return round($number/1000) . 'K';
            case $number >= 1000 || $number <= -1000:
                return number_format($number, 0, '', ' ');
            default:
                return str_replace(".00", "", number_format ($number, 2, ".", " "));

        }

    }

}