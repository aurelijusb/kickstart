<?php

declare(strict_types=1);

namespace App\Services;

class NumberFormatter
{
    private const MILLION = 999500;
    private const NEGATIVE_MILLION = -999500;
    private const ONE_HUNDRED_K = 99950;
    private const NEGATIVE_ONE_HUNDRED_K = -99950;
    private const THOUSAND = 999.9999;
    private const NEGATIVE_THOUSAND = -1000;
    private const ZERO = 0;
    private const MILLION_SIGN = 'M';
    private const THOUSAND_SIGN = 'K';


    /**
     * @param float $number
     * @return string
     */
    public function formatNumbers(float $number): string
    {
        $result = 0;

        switch ($number) {
            case (self::MILLION <= $number || self::NEGATIVE_MILLION >= $number):
                $result = $this->aboveMillion($number);
                break;

            case (
                (self::ONE_HUNDRED_K <= $number && self::MILLION > $number)
                || (self::NEGATIVE_ONE_HUNDRED_K >= $number && self::NEGATIVE_MILLION < $number)
            ):
                $result = $this->aboveOneHundredK($number);
                break;

            case (
                (self::THOUSAND <= $number && self::ONE_HUNDRED_K > $number)
                || (self::NEGATIVE_THOUSAND >= $number && self::NEGATIVE_ONE_HUNDRED_K < $number)
            ):
                $result = $this->aboveThousand($number);
                break;

            case (
                (self::ZERO <= $number && self::THOUSAND > $number)
                || (self::ZERO >= $number && self::NEGATIVE_THOUSAND < $number)
            ):
                $result = $this->underThousand($number);
                break;

        }

        return strval($result);
    }

    /**
     * @param float $number
     * @return string
     */
    private function aboveMillion(float $number): string
    {
        $shortNumber = number_format($number / 1000000, 2);

        return strval($shortNumber . self::MILLION_SIGN);
    }

    /**
     * @param float $number
     * @return string
     */
    private function aboveOneHundredK(float $number): string
    {
        $shortNumber = number_format($number / 1000);

        return strval($shortNumber . self::THOUSAND_SIGN);
    }

    /**
     * @param float $number
     * @return string
     */
    private function aboveThousand(float $number): string
    {
        $shortNumber = number_format($number / 1, 0 , '', ' ');

        return strval($shortNumber);
    }

    /**
     * @param float $number
     * @return string
     */
    private function underThousand(float $number): string
    {
        $numb = number_format($number,2);
        $shortNumber = floatval($numb);

        return strval($shortNumber);
    }
}
