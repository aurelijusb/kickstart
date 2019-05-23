<?php


namespace App\Services;


class NumberFormatter implements NumberFormatterInterface
{

    public function format(float $numb): ?string
    {
        $numb = round($numb, 2);

        if (($numb >= 999500) || ($numb <= -999500)) {
            return number_format($numb / 1000000, 2) . 'M';
        } elseif (($numb >= 99950 && $numb < 999500) || ($numb <= -99950 && $numb > -999500)) {
            return number_format($numb / 1000, 0) . 'K';
        } elseif (($numb >= 1000 && $numb < 99950) || ($numb <= -1000 && $numb > -99950)) {
            return number_format($numb, 0, '', ' ');
        }

        return number_format($numb, 2, '.', '');
    }
}