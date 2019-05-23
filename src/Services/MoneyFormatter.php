<?php

namespace App\Services;

/**
 * Class MoneyFormatter
 * @package App\Services
 */
class MoneyFormatter
{

    private $numberFormatter = null;

    /**
     * MoneyFormatter constructor.
     * @param NumberFormatterInterface $numbFormatter
     */
    public function __construct(NumberFormatterInterface $numbFormatter)
    {
        $this->numberFormatter = $numbFormatter;
    }

    /**
     * @param float $numb
     * @return string
     */
    public function formatEur(float $numb) :string
    {
        return $this->numberFormatter->formatNumber($numb) . ' €';
    }

    /**
     * @param float $numb
     * @return string
     */
    public function formatUsd(float $numb) :string
    {
        return '$' . $this->numberFormatter->formatNumber($numb);
    }
}
