<?php

declare(strict_types=1);

namespace App\Services;

class MoneyFormatter
{
    /** @var NumberFormatter */
    private $numberFormatter;

    public function __construct(NumberFormatter $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }

    /**
     * @param float $number
     * @return string
     */
    public function formatEur(float $number): string
    {
        $value = $this->numberFormatter->formatNumbers($number);

        return strval($value . ' €');
    }

    /**
     * @param float $number
     * @return string
     */
    public function formatUsd(float $number): string
    {
        $value = $this->numberFormatter->formatNumbers($number);

        return strval('$' . $value);
    }
}