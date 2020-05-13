<?php

declare(strict_types=1);

use App\Application\Services\ProcessaCorridaServiceImpl;
use DI\ContainerBuilder;

use Psr\Container\ContainerInterface;

///////////////////////////////////////////// SERVICES DEPENDENCIES //////////////////////////////////////////////

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([

        ProcessaCorridaServiceImpl::class => function (ContainerInterface $container) {
            return new ProcessaCorridaServiceImpl();
        }

    ]);
};
