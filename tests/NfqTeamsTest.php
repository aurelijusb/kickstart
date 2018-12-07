<?php

namespace App\Tests;

use App\Services\NfqTeams;
use PHPUnit\Framework\TestCase;

class NfqTeamsTest extends TestCase
{
    public function testEmpty()
    {
        $teams = new NfqTeams([]);
        $this->assertNull($teams->getTeamByMember('not Existing'));
        $this->assertNull($teams->getTeamByMentor('not Existing'));
    }

    public function testValidMentor()
    {
        $teams = new NfqTeams(
            [
                'academyui' => [
                    'mentors' => ['Jonas Jonaitis'],
                    'students' => ['Petras Petraitis', 'Gedas Gražauskas'],
                ],
                'supperreal' => [
                    'mentors' => ['Vardenis Pavardenis', 'Ada Kalbenė'],
                    'students' => ['Vytautas Vėjūnas'],
                ],
            ]
        );
        $this->assertEquals('academyui', $teams->getTeamByMentor('Jonas Jonaitis'));
        $this->assertEquals('supperreal', $teams->getTeamByMentor('Ada Kalbenė'));
    }

    public function testValidMember(){
        $teams = new NfqTeams(
            [
                'academyui' => [
                    'mentors' => ['Jonas Jonaitis'],
                    'students' => ['Petras Petraitis', 'Gedas Gražauskas'],
                ],
                'supperreal' => [
                    'mentors' => ['Vardenis Pavardenis', 'Ada Kalbenė'],
                    'students' => ['Vytautas Vėjūnas'],
                ],
            ]
        );
        $this->assertEquals('academyui', $teams->getTeamByMember('Gedas Gražauskas'));
        $this->assertEquals('supperreal', $teams->getTeamByMember('Vytautas Vėjūnas'));
    }

    public function testInvalidMember()
    {
        $teams = new NfqTeams(
            [
                'academyui' => [
                    'mentors' => ['Jonas Jonaitis'],
                    'students' => ['Petras Petraitis', 'Gedas Gražauskas'],
                ],
                'supperreal' => [
                    'mentors' => ['Vardenis Pavardenis', 'Ada Kalbenė'],
                    'students' => ['Vytautas Vėjūnas'],
                ],
            ]
        );
        $this->assertNull($teams->getTeamByMember('Neegzistuojantis'));
    }
    public function testInvalidMentor()
    {
        $teams = new NfqTeams(
            [
                'academyui' => [
                    'mentors' => ['Jonas Jonaitis'],
                    'students' => ['Petras Petraitis', 'Gedas Gražauskas'],
                ],
                'supperreal' => [
                    'mentors' => ['Vardenis Pavardenis', 'Ada Kalbenė'],
                    'students' => ['Vytautas Vėjūnas'],
                ],
            ]
        );
        $this->assertNull($teams->getTeamByMentor('Neegzistuojantis'));
    }
}

