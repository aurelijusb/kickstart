<?php

namespace App\Services;

interface NumberFormatterIntercafe
{
    /**
     * @param float $number
     * @return string
     */
    public function format(float $number): string;
}
