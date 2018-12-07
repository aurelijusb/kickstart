<?php

namespace App\Formatter;


class NumberFormatter
{

    public function floatToString(float $number) :string
    {
        $result = '';
        $numberAbs = abs($number);

        if ($numberAbs >= 999500) {
            $result = $this->floatToStringMillions($numberAbs);
        } else if (99950 <= $numberAbs AND $numberAbs < 999500) {
            $result = $this->floatToStringHundredsThousands($numberAbs);
        } else if (1000 <= $numberAbs AND $numberAbs <= 99950) {
            $result = $this->floatToStringThousands($numberAbs);
        } else if (0 <= $numberAbs AND $numberAbs < 1000) {
            $result = $this->floatToStringLowerThanThousand($numberAbs);
        }

        if ($number < 0) {
            $result = '-' . $result;
        }

        return $result;
    }

    //Milijonas ir daugiau sutrumpinami iki milijonų ir paliekami du skaičiai po kablelio.
    //(2835779  => 2.84M; 999500 => 1.00M) (Galioja 999 500 ≤ x < ∞)
    private function floatToStringMillions(float $number)
    {
        $millions =  round($number / 1000000, 2);

        return number_format($millions, 2, '.', '') . "M";
    }


    //100 000 ir daugiau trumpinami iki tūkstančių.
    //(535216  => 535K; 99950 => 100K)
    private function floatToStringHundredsThousands(float $number)
    {
        $thousands = round($number / 1000, 0);
        return $thousands. "K";
    }

    //1000 ir daugiau apvalinama sveikųjų tikslumu. Tarp tūkstančių ir šimtų vienas tarpas. (27533.78 => 27 534) (Galioja 1 000 ≤ x < 99 950)
    //Pastaba: 999.99 => 999.99, o 999.9999 => 1 000
    private function floatToStringThousands(float $number)
    {
        $rounded = (int) round($number, 0);
        $thousandsPart = (int) floor($rounded / 1000);
        $hundredsPart =  (int) ($rounded - $thousandsPart * 1000);
        return $thousandsPart . ' ' . $hundredsPart;
    }


    //Visi kiti skaičiai apvalinami ir po kablelio rodomi du skaitmenys. Jeigu abu jie yra nuliai - rodomas sveikas skaičius.
    //(533.1 => 533.10; 66.6666 => 66.67, 12.00 => 12)
    //(Galioja 0 ≤ x < 1 000)
    private function floatToStringLowerThanThousand(float $number)
    {
        $rounded = round($number, 2);
        
        if (floor($rounded) === $rounded) { //has no decimals
           $result = (string)(int) $rounded;     
        } 

        $result = number_format($rounded, 2, '.', '');
        return $result;
    }
}