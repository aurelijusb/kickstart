<?php


namespace App\Services;


class NumberFormatter
{
    public function formatCurrency(float $number): string
    {
        //Panaikinam nereikalingus simbolius
        $stripped_number = (0+str_replace(",","", $number));

        //Tikrinam, ar paduotas skaičius
        if(!is_numeric($stripped_number)) return false;

        switch ($stripped_number) {
            case $stripped_number >= 999500 || $stripped_number <= -999500:
                return number_format($stripped_number/1000000, 2) . 'M';
            case $stripped_number >= 99950 || $stripped_number <= -99950:
                return round($stripped_number/1000) . 'K';
            case $stripped_number >= 1000 || $stripped_number <= -1000:
                return number_format($stripped_number, 0, '', ' ');
            default:
                return str_replace(".00", "", number_format ($stripped_number, 2, ".", ""));

        }

    }

}