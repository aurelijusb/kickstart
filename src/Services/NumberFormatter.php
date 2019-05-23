<?php

namespace App\Services;

/**
 * Class NumberFormatter
 * @package App\Services
 */
class NumberFormatter implements NumberFormatterInterface{

    /**
     * @param float $numb
     * @return string
     */
    public function formatNumber(float $numb): ?string
    {
        $absolute = abs(round($numb, 2));
        switch ($absolute) {
            case $absolute === 0:
                return '0.00';
            case $absolute >= 999500 :
                return sprintf('%.2fM', $numb / 1000000);
            case $absolute >= 99950 && $absolute < 999500:
                return sprintf('%dK', round((int)$numb / 1000));
            case $absolute >= 1000 && $absolute < 99950:
                $temp = round(($numb / 1000), 3);
                return sprintf('%s', number_format($temp, 3, ' ', ''));
            case $absolute >= 0 && $absolute < 1000 :
                return sprintf('%.2f', $numb);
        }
        return null;
    }
}