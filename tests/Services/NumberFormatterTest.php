<?php

declare(strict_types=1);

namespace App\Tests\Services;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    /** @var NumberFormatter */
    private $number;

    public function testNumberFormatter()
    {
        $this->assertIsFloat($this->number->formatNumbers());
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->number = new NumberFormatter();
    }
}
