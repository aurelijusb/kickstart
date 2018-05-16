<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\WebDriver;

class Acceptance extends \Codeception\Module
{
    public function amRedirectedTo($path)
    {
        /** @var WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');
        $actual = $webDriver->executeJS('return window.location.pathname');
        $this->assertEquals($path, $actual, 'Browser path does not match expected');
    }
}
