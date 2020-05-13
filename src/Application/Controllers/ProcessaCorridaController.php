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
        $uploadedFiles = $request->getUploadedFiles();

        $uploadedFile = $uploadedFiles['file'];

        $uploadedFile->moveTo('../temp/' . date('dmY') . '.csv');
        $result = $this->service->processarCorrida();
        $payload = json_encode($result);

        $response->getBody()->write($payload);
        return $response
            ->withStatus(201);
    }

    
    
    /**
     * {@inheritdoc}
     */
    protected function action()
    {
    }
}
