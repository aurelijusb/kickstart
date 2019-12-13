<?php
use App\Controller\HomeController;
use App\Controller\StudentController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('teamGit', '/teamGit/{slug}')
        ->controller([HomeController::class, 'teamGit'])
    ;
    $routes->add('teamWeb', '{slug}projektai.nfqakademija.lt/');
    $routes->add('students', 'students.json');
};
