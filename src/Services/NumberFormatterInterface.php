<?php

namespace App\Services;

/**
 * Interface NumberFormatterInterface
 * @package App\Services
 */
interface NumberFormatterInterface{

    /**
     * @param float $numb
     * @return null|string
     */
    public function formatNumber(float $numb) :?string;

}