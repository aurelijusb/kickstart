<?php

namespace App\FormatterService;


interface NumberFormatterInterface
{

    public function numberFormatter(float $number): string;

}