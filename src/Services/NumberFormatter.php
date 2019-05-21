<?php

declare(strict_types=1);

namespace App\Services;

class NumberFormatter
{
    private const MILLION = 1000000;
    private const ONE_HUNDRED_K = 100000;
    private const MILLION_SIGN = 'M';

    /**
     * @return string
     */
    public function formatNumbers(): string
    {
//        $number = (int)1555501;
        $number = (int)1000001;
//        $number = (int)999500;
//        $number = (int)555555;

        switch ($number) {
            case (self::MILLION <= $number):
                $aboveMillion = $this->aboveMillion($number);
                break;

            case (self::ONE_HUNDRED_K <= $number && self::ONE_HUNDRED_K > $number):
                $font_size = "16";
                break;

            case ($number <= 40):
                $font_size = "18";
                break;

            case ($number <= 50):
                $font_size = "20";
                break;
        }



        return $aboveMillion;
    }

    /**
     * @param int $number
     * @return string
     */
    private function aboveMillion(int $number): string
    {
        $shortNumber = number_format($number / 1000000, 2);
        $value = self::MILLION <= $number ? $shortNumber . self::MILLION_SIGN : $number;

        return strval($value);
    }

    private function aboveOneHundredK(int $number)
    {
        
    }
}
