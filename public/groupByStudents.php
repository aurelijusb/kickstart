 <?php

 private function groupByStudents(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }
}


["devcollab"]=>
  array(3) {
    ["name"]=>
    string(26) "Education sharing platform"
    ["mentors"]=>
    array(1) {
      [0]=>
      string(8) "Viktoras"
    }
    ["students"]=>
    array(4) {
      [0]=>
      string(7) "Karolis"
      [1]=>
      string(5) "Arnas"
      [2]=>
      string(7) "Evaldas"
      [3]=>
      string(8) "Algirdas"
    }
  }