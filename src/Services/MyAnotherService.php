<?php
namespace App\Services;

class MyAnotherService implements MyServiceInterface
{
    public function sum($a, $b) {
        return $a . $b;
    }
}