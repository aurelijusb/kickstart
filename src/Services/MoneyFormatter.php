<?php

namespace App\Services;

class MoneyFormatter
{

    private $numberFormatter = null;

    public function __construct(NumberFormatterInterface $numbFormatter)
    {
        $this->numberFormatter = $numbFormatter;
    }

    public function formatEur(float $number): string
    {
        return $this->numberFormatter->format($number) . ' €';
    }

    public function formatUsd(float $number): string
    {
        return '$'. $this->numberFormatter->format($number);
    }

}