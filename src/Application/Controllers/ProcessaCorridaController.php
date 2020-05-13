<?php

declare(strict_types=1);

namespace App\Application\Controllers;

use App\Application\Controllers\Action;
use App\Application\Interfaces\Service\ProcessaCorridaService;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class ProcessaCorridaController extends action
{
    private $service;

    public function __construct(
        LoggerInterface $logger,
        ProcessaCorridaService $service
    ) {
        parent::__construct($logger);
        $this->service = $service;
    }


    public function processarCorrida($request, ResponseInterface $response,  $args)
    {
        $result =  $this->service->processarCorrida();

    }

    
    /**
     * {@inheritdoc}
     */
    protected function action()
    {
    }
}
