<?php

namespace App\Service;


class ProjectsData implements ProjectsDataInterface
{
    private $dataFile;
    
    public function __construct(string $dataFile)
    {
        $this->setDataFile($dataFile);
    }
    
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
     * @return ProjectsDataInterface
     */
    public function setDataFile(string $dataFile): ProjectsDataInterface
    {
        $this->dataFile = $dataFile;
        return $this;
    }
    
}