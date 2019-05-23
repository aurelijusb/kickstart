<?php namespace App\Services;

class MoneyFormatter
{

    private $numberFormatter;
    /**
     * @param NumberFormatterInterface $numberFormatter
     */

    public function __construct(NumberFormatterInterface $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }

    /**
     * @param float
     * @return string
     */
    public function formatEur(float $number) :string
    {
        return $this->numberFormatter->formatNumber($number). ' €';
    }

    /**
     * @param float
     * @return string
     */
    public function formatUsd(float $number) :string
    {
        return '$'. $this->numberFormatter->formatNumber($number);
    }
}