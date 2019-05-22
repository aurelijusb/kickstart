<?php

namespace App\Services;

interface NumberFormatterInterface
{
    /**
     * @param float $number
     * @return string
     */
    public function format(float $number): string;
}
