<?php

namespace App\Service;


class ProjectsData
{
    private $dataFile = 'students.json';
    
    public function getData()
    {
        $data = file_get_contents($this->dataFile);
        if ($data === false) {
            return false;
        }
        
        return json_decode($data, true);
    }
    
    /**
     * @return string
     */
    public function getDataFile(): string
    {
        return $this->dataFile;
    }
    
    /**
     * @param string $dataFile
     * @return ProjectsData
     */
    public function setDataFile(string $dataFile): ProjectsData
    {
        $this->dataFile = $dataFile;
        return $this;
    }
    
}