<?php

declare(strict_types=1);

namespace App\Services;

class NumberFormatter
{
    private const MILLION = 999500;
    private const ONE_HUNDRED_K = 100000;
    private const THOUSAND = 1000;
    private const HUNDRED = 100;
    private const MILLION_SIGN = 'M';
    private const THOUSAND_SIGN = 'K';


    /**
     * @return string
     */
    public function formatNumbers(): string
    {
//        $number = (int)1555501;
//        $number = (int)1000001;
//        $number = (int)999500;
//        $number = (int)555555;
        $number = (int)12345;

        switch ($number) {
            case (self::MILLION <= $number):
                $aboveMillion = $this->aboveMillion($number);
                break;

            case (self::ONE_HUNDRED_K <= $number && self::MILLION > $number):
                $aboveMillion = $this->aboveOneHundredK($number);
                break;

            case (self::THOUSAND <= $number && self::ONE_HUNDRED_K > $number):
                $aboveMillion = $this->aboveThousand($number);
                break;

            case (self::HUNDRED <= $number && self::THOUSAND > $number):
                $this->underThousand($number);
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
        return strval($shortNumber . self::MILLION_SIGN);
    }

    /**
     * @param int $number
     * @return string
     */
    private function aboveOneHundredK(int $number): string
    {
        $shortNumber = number_format($number / 1000);
        return strval($shortNumber . self::THOUSAND_SIGN);
    }

    /**
     * @param int $number
     * @return string
     */
    private function aboveThousand(int $number): string
    {
        $shortNumber = number_format($number / 1, 0 , '', ' ');
        return strval($shortNumber);
    }

    /**
     * @param int $number
     * @return string
     */
    private function underThousand(int $number): string
    {
        $shortNumber = number_format($number / 1000);
        return strval($shortNumber . self::THOUSAND_SIGN);
    }
}
