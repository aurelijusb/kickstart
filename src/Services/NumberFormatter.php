<?php

namespace App\Services;

class NumberFormatter implements NumberFormatterInterface
{
    /**
     * @param float $number
     * @return string
     */
    public function format(float $number): string
    {
        $result = '';
        $negative = false;
        if ($number < 0) {
            $negative = true;
            $number = -1 * $number;
        }
        $number = round($number, 2);
        if ($number >= 999500) {
            $result = (string) number_format($number / 1000000, 2, '.', ' ') . 'M';
        } elseif ($number >= 99950) {
            $result = (string) number_format($number / 1000) . 'K';
        } elseif ($number >= 1000) {
            $result = (string) number_format($number, 0, '.', ' ');
        } else {
            if (floor($number) == $number) {
                $result = (string) number_format($number);
            } else {
                $result = (string) number_format($number, 2, '.', ' ');
            }
        }

        if ($negative) {
            return '-'.$result;
        } else {
            return $result;
        }
    }
}
