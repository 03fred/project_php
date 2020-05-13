<?php

namespace App\Application\Services;

use App\Application\Helpers\Helpers;
use App\Application\Interfaces\Service\ProcessaCorridaService;

class ProcessaCorridaServiceImpl implements ProcessaCorridaService
{

    public function processarCorrida(): array
    {
        $delimitador = ';';
        $cerca = '"';
        $ordenaVoltas = [];
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

                $piloto = Helpers::soLetra($linha[1]);

                $ordenaVoltas[$piloto][] = $this->formatarLinhasArray($linha);
            }
            fclose($f);
            return $ordenaVoltas;
        }
    }

    private function formatarLinhasArray(array $volta)
    {
        $arrayFormatado = [];
        $arrayFormatado['tempo'] = trim($volta[0]);
        $arrayFormatado['volta'] = trim($volta[2]);
        $arrayFormatado['tempoVolta'] = trim($volta[3]);
        $arrayFormatado['velocidadeMedia'] = trim($volta[4]);
        return $arrayFormatado;
    }
}
