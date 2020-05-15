<?php

namespace App\Application\Services;

use App\Application\DTO\VoltasDTO;
use App\Application\Helpers\Helpers;
use App\Application\Interfaces\Service\ProcessaCorridaService;
use App\Application\Interfaces\Service\RanquiaCorridaService;


class ProcessaCorridaServiceImpl implements ProcessaCorridaService
{
    private $ranquiaVoltaService;

    public function __construct(RanquiaCorridaService $ranquiaVoltaService)
    {
        $this->ranquiaVoltaService = $ranquiaVoltaService;
    }

    public function processarCorrida()
    {
        $delimitador = ';';
        $cerca = '"';
        $ordenaVoltas = [];
        $detalhamentoVoltas = [];
        $f = fopen('../temp/' . date('dmY') . '.csv', 'r');
        if ($f) {

            // Ler cabecalho do arquivo
            $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);

            // Enquanto nao terminar o arquivo
            while (!feof($f)) {

                // Ler uma linha do arquivo
                $linha = fgetcsv($f, 0, $delimitador, $cerca);
                if (!$linha) {
                    continue;
                }

                $id = Helpers::soNumero($linha[1]);

                $dadosVolta = $this->formatarLinhasArray($linha);
                $ordenaVoltas[$id][] = $dadosVolta;

                array_push($detalhamentoVoltas, $dadosVolta);
            }

            return array_merge(
                array(
                    'detalhamentoVoltas' => $detalhamentoVoltas
                ),

                $this->ranquiaVoltaService->ranquiarVolta($ordenaVoltas)
            );
        }
    }

    private function formatarLinhasArray(array $volta)
    {
        $arrayFormatado = [];
        $arrayFormatado['tempo'] = trim($volta[0]);
        $arrayFormatado['id'] = Helpers::soNumero($volta[1]);
        $arrayFormatado['nome'] = Helpers::soLetra($volta[1]);
        $arrayFormatado['volta'] = trim($volta[2]);
        $arrayFormatado['tempoVolta'] = trim($volta[3]);
        $arrayFormatado['velocidadeMedia'] = trim($volta[4]);
        return $arrayFormatado;
    }
}
