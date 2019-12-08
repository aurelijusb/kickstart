<?php

namespace App\Services;

/**
 * Class StudentDataService
 * @package App\Services
 */
class StudentDataService
{
    /**
     * @return array
     */
    public static function getData()
    {
        $json = file_get_contents('https://hw1.nfq2019.online/students.json');
        $obj = json_decode($json, true);

        $teams = [];
        $students = [];

        foreach ($obj as $team) {
            $teams[] = $team['name'];
            foreach ($team['students'] as $student) {
                $students[] = ['student' => $student, 'project' => $team['name'], 'mentor' => $team['mentors']];
            }
        }

        return [
            'students' => $students,
            'teams' => $teams
        ];
    }
}
