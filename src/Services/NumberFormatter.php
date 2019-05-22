<?php

namespace App\Services;

class NumberFormatter
{
    public function numberFormatter(float $value): ?string
    {
        $value = round($value, 3, PHP_ROUND_HALF_UP);

        if ((999500 <= $value) || (-999500 >= $value)) {
            return number_format($value / 1000000, 2) . 'M';
        }
        if (((99950 <= $value) && ($value < 999500)) || ((-99950 >= $value) && ($value > -999500))) {
            return number_format($value / 1000, 0) . 'K';
        }
        if (((1000 <= $value) && ($value < 99950)) || ((-1000 >= $value) && ($value > -99950))) {
            return number_format($value, 0, '', ' ');
        }

        return number_format($value, 2, '.', '');
    }
}
