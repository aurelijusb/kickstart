<?php
use App\Controller\HomeController;
use App\Controller\StudentController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('teamGit', '/teamGit/{slug}')
        ->controller([HomeController::class, 'teamGit'])
    ;
    $routes->add('teamWeb', '/teamWeb/{slug}')
        ->controller([HomeController::class, 'teamWeb'])
    ;
    $routes->add('studentsFile', '/studentsFile')
        ->controller([StudentController::class, 'studentsFile'])
    ;
    $routes->add('students', 'students.json')
    ;
};
