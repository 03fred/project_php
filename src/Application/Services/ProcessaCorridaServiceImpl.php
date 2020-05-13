<?php

namespace App\Application\Services;

use App\Application\Helpers\Helpers;
use App\Application\Interfaces\Service\ProcessaCorridaService;

class ProcessaCorridaServiceImpl implements ProcessaCorridaService
{

    public function processarCorrida()
    {
        $delimitador = ';';
        $cerca = '"';
        $ordenaVoltas = [];
        $f = fopen('../temp/'. date('dmY') . '.csv', 'r');
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

                $piloto = Helpers::retiraNumeros($linha[1]);

                $ordenaVoltas[$piloto][] = $linha;
            }

            var_dump($ordenaVoltas);
            fclose($f);
            die;
        }
    }
}
