<?php
declare(strict_types=1);

namespace App\Service;

class DataProvider
{
    public function getStudents(): array
    {
        $students = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $teams) {
            foreach ($teams['students'] as $student) {
                $students[] = strtolower($student);
            }
        }

        return $students;
    }

    public function getTeams(): array
    {
        return array_map('strtolower', array_keys(json_decode($this->getStorage(), true)));
    }

    private function getStorage()
    {
        return /** @lang json */
            '{
              "knygnesiai": {
                "name": "Knygų mainai",
                "mentors": [
                  "Karolis"
                ],
                "students": [
                  "Mindaugas",
                  "Tadas"
                ]
              },
              "carbooking": {
                "name": "Car booking",
                "mentors": [
                  "Monika",
                  "Tomas"
                ],
                "students": [
                  "Matas",
                  "Adomas",
                  "Aidas"
                ]
              },
              "academyui": {
                "name": "NFQ Akademijos puslapis",
                "mentors": [
                  "Tomas"
                ],
                "students": [
                  "Indrė"
                ]
              },
              "buhalteriui": {
                "name": "Pagalba buhalteriui",
                "mentors": [
                  "Aistis"
                ],
                "students": [
                  "Geraldas",
                  "Matas"
                ]
              },
              "mapsportas": {
                "name": "Sporto draugas",
                "mentors": [
                  "Agnis"
                ],
                "students": [
                  "Mantas",
                  "Pijus"
                ]
              },
              "trainme": {
                "name": "Asmeninio trenerio puslapis",
                "mentors": [
                  "Laurynas"
                ],
                "students": [
                  "Ignas",
                  "Gintautas"
                ]
              }
            }';
    }
}

