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
        if (contains($line, '|escape') || contains($line, '|e ')  || contains($line, '| e ')) {
            $actions->error($path, $nr, $line, "Symfony standartiškai yra įjungęs autoescape, tai papildomai rašyti |escape filtro nereikia. https://symfony.com/doc/4.3/templates.html#output-escaping");
        }
        if (contains($line, '{% set ')) {
            $actions->error(
                $path,
                $nr,
                $line,
                "Symfony karkase speciailiai atskiriama verslo logika (Controller/PHP) ir atvaizdavimas (Twig). " .
                "Todėl visus sudėtingesnius apskaičiavimus geriau laikyti PHP pusėje, nes PHP kodą yra pogiau automatiškai testuoti 
                arba derinti (debug) negu iš Twig sugeneruotą kodą. 
                Realiuose projektuose ši problema taip pat sprendžiama ir su nepriklausomai ištestuojamais https://symfony.com/doc/current/templating/twig_extension.html
                Namų darbe užtenkta tiesiog perkleti logiką į Controller");
        }
        if (contains($line, '{{ controller_name }}')) {
            $actions->warning($path, $nr, $line,"Verta nepalikinėti šiukšlių, nes kolegos skaitys VISUS tavo kodo pakeitimus. https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/about-pull-request-reviews");
        }
    }
}

if ($actions->hadErrors()) {
    echo "!!!!! Not all tests passed. Check GitHub 'File changes' tab for line to line annotations !!!!!\n";
    exit(1);
}