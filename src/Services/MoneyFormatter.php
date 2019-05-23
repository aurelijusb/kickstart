<?php

namespace App\Services;

class MoneyFormatter
{
    private $numberFormater;
    /**
     * @param $numberFormater
     */
    public function __construct(NumberFormater $numberFormater)
    {
        $this->numberFormater = $numberFormater;
    }
    /**
     * @param float
     * @return string
     */
    public function formatEur(float $number) :string
    {
        return $this->numberFormater->formatNumber($number). ' €';
    }
    /**
     * @param float
     * @return string
     */
    public function formatUsd(float $number) :string
    {
        return '$'. $this->numberFormater->formatNumber($number);
    }
}