<?php

namespace App\Services;

class MoneyFormatter
{
    /**
     * @var NumberFormatterInterface
     */
    private $numberFormatter;

    public function __construct(NumberFormatterInterface $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }

    /**
     * @param $number
     * @return string
     */
    public function formatEur($number): string
    {
        $result = $this->numberFormatter ->format($number);
        return $result.' €';
    }

    /**
     * @param $number
     * @return string
     */
    public function formatUsd($number): string
    {
        $result = $this->numberFormatter ->format($number);
        return '$'.$result;
    }
}
