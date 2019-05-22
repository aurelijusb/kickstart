<?php

namespace App\Services;

class MoneyFormatter
{
    /**
     * @var NumberFormatter
     */
    private $numberFormatter;

    /**
     * MoneyFormatter constructor.
     *
     * @param NumberFormatter $numberFormatter
     */
    public function __construct(NumberFormatter $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }

    public function formatEur(float $value): ?string
    {
        return $this->numberFormatter->numberFormatter($value) . ' €';
    }

    public function formatUsd(float $value): ?string
    {
        return '$' . $this->numberFormatter->numberFormatter($value);
    }
}
