<?php


namespace App\Services;


class MoneyFormatter
{
    private $numberFormatter;

    public function __construct(NumberFormatter $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }

    public function formatEur($number): string
    {
        $formattedNumber = $this->numberFormatter->formatCurrency($number);

        return $formattedNumber . '€';
    }

    public function formatUsd($number): string
    {
        $formatterNumber = $this->numberFormatter->formatCurrency($number);

        return '$' . $formatterNumber;
    }


}