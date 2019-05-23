<?php

namespace App\Services;

interface NumberFormatterInterface
{
    public function format(float $numb): ?string;

}
