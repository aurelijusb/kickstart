<?php

class GitHubActions
{
    private $errors = 0;

    function error($file, $line, $context, $text)
    {
        $this->errors++;
        $context = trim($context);
        echo "Testing file: $file\n";
        echo "Testing line: $context\n";
        $line++; // To show notice bellow line
        echo "::error file=$file,line=$line,col=0::$text\n";
    }

    function warning($file, $line, $context, $text)
    {
        $this->errors++;
        $context = trim($context);
        echo "Testing file: $file\n";
        echo "Testing line: $context\n";
        $line++; // To show notice bellow line
        echo "::warning file=$file,line=$line,col=0::$text\n";
    }

    function hadErrors()
    {
        return $this->errors > 0;
    }
}

class Twig
{
    /** @var GitHubActions */
    private $gitHubActions;

    /**
     * @param GitHubActions $gitHubActions
     */
    public function __construct(GitHubActions $gitHubActions)
    {
        $this->gitHubActions = $gitHubActions;
    }

    private function root()
    {
        return dirname(dirname(__DIR__));
    }

    private function recursiveScan($root, $extension)
    {
        $directory = new RecursiveDirectoryIterator($root);
        $iterator = new RecursiveIteratorIterator($directory);
        $matches = [];
        /** @var SplFileInfo $item */
        foreach ($iterator as $item) {
            if ($item->getExtension() === $extension) {
                $matches[] = $item->getRealPath();
            }
        }
        return $matches;
    }

    function files()
    {
        return $this->recursiveScan($this->root() . '/templates/', 'twig');
    }

    function relative($path)
    {
        return substr($path, strlen($this->root() . '/'));
    }
}

function contains($line, $needle)
{
    return strpos($line, $needle) !== false;
}

$actions = new GitHubActions();
$twig = new Twig($actions);
$files = $twig->files();
foreach ($files as $file) {
    $path = $twig->relative($file);
    $lines = file($file);
    foreach ($lines as $nr => $line) {

        // Common mistakes
        if (contains($line, '/student')) {
            $actions->error($path, $nr, $line, "Twig'e visi keliai turėtų naudoti path komandą. https://symfony.com/doc/current/templates.html#linking-to-pages");
        }
        if (contains($line, '|escape')) {
            $actions->warning($path, $nr, $line, "Symfony standartiškai yra įjungęs autoescape, tai papildomai rašyti |escape filtro nereikia. https://symfony.com/doc/4.3/templates.html#output-escaping");
        }
        
    }
}

if ($actions->hadErrors()) {
    echo "!!!!! Not all tests passed. Check GitHub 'File changes' tab for line to line annotations !!!!!\n";
    exit(1);
}