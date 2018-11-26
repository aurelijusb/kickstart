<?php
namespace App\Services;

class MyService implements MyServiceInterface
{
    public function sum($a, $b) {
        return $a + $b;
    }
}