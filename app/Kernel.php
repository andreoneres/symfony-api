<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureRoutes(RoutingConfigurator $routes): void
{
    $extensions = '{php,yaml}';
    $routes->import('../routes/{routes}/' . $this->environment . "/*.$extensions");
    $routes->import("../routes/{routes}/*.$extensions");
    $routes->import("../routes/{routes}.$extensions");
}
}
