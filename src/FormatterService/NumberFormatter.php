<?php

namespace App\FormatterService;


class NumberFormatter
{
    /**
     * @param float $number
     * @return string
     */
    private function formatToMillionNumber(float $number): string
    {
        $number = number_format(($number / 1000000), 2);
        return $number . "M";
    }

    private function formatToThousandNumber(float $number): string
    {
        $number = number_format($number / 1000);
        return $number . "K";
    }

    private function formatToThousandNumberWithSpace(float $number): string
    {
        $number = number_format($number, 0, '.', ' ');
        return $number;
    }

    private function formatToDefaultNumber(float $number): string
    {
        $number = number_format($number, 2, '.', ' ');
        $numbers = explode(".", $number);
        if ($numbers[1] === "00") {
            $number = $numbers[0];
        }
        return $number;
    }

    public function numberFormatter(float $number): string
    {
        $isNegative="";
        if ($number < 0) {
            $number = abs($number);
            $isNegative = "-";
        }

        if ($number >= 999500) {
            return $isNegative.$this->formatToMillionNumber($number);
        } elseif ($number >= 100000) {
            return $isNegative.$this->formatToThousandNumber($number);
        } elseif ($number >= 1000 && $number < 99950) {
            return $isNegative.$this->formatToThousandNumberWithSpace($number);
        } else {
            return $isNegative.$this->formatToDefaultNumber($number);
        }
    }

}