<?php

namespace App\Services;

class NumberFormater implements NumberFormatterInterface
{
    /**
     * @param float $number
     * @return string
     */
    public function formatNumber(float $number) :string
    {
        $absValue = abs(round($number, 2));
        switch ($absValue) {
            case $absValue === 0:
                return '0.00';
            case $absValue >= 999500:
                $formattedNumber = number_format($number / 1000000, 2, '.', ' ') . 'M';
                break;
            case $absValue >= 99950 && $absValue < 999500:
                $formattedNumber = number_format($number / 1000) . 'K';
                break;
            case $absValue >= 1000 && $absValue < 99950:
                $formattedNumber = number_format($number, 0, '', ' ');
                break;
            default:
                $fraction  = $absValue - (int) $absValue;
                if ($fraction !=0) {
                    $formattedNumber = number_format($number, 2);
                } else {
                    $formattedNumber = number_format($number);
                }
                break;
        }
        return $formattedNumber;
    }
}