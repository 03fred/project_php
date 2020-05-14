<?php

namespace App\Application\Services;

use App\Application\Helpers\Helpers;
use App\Application\Interfaces\Service\RanquiaCorridaService;

class RanquiaCorridaServiceImpl implements RanquiaCorridaService
{

    public function ranquiarVolta(array $voltas)
    {
        $idPrimeiroPiloto = array_key_first($voltas);

        $melhorVoltaCorrida = $voltas[$idPrimeiroPiloto][0];
        $melhorVoltaPiloto = [];

        foreach ($voltas as $voltasPiloto) {

            $auxMelhorVolta = $this->melhorVolta($voltasPiloto, $velMedia, $tempoProva);

            if ($melhorVoltaCorrida['tempoVolta'] > $auxMelhorVolta['tempoVolta']) {
                $melhorVoltaCorrida = $auxMelhorVolta;
            }

            $auxMelhorVolta['velociadeMediaTotal'] =  $velMedia;

            $auxMelhorVolta['tempoTotalProva'] = Helpers::somarHoras($tempoProva);

            if (count($melhorVoltaPiloto) > 0) {

                $difencaParaPrimeiroColocado = $this->calcularDiferenca(
                    $auxMelhorVolta['tempoTotalProva'],
                    $melhorVoltaPiloto[0]['tempoTotalProva']
                );

                $auxMelhorVolta['tempoAtrasPrimeiroColado'] = Helpers::formatarTempo($difencaParaPrimeiroColocado);
            }

            array_push($melhorVoltaPiloto, $auxMelhorVolta);
        }

        var_dump($melhorVoltaCorrida, $melhorVoltaPiloto);
        die;
    }


    private function melhorVolta($voltasPiloto, &$velMedia, &$tempoProva): array
    {

        $min = $voltasPiloto[0];
        $tempoProva = [];
        $velMedia = 0;
        $media = 0;

        foreach ($voltasPiloto as $volta) {

            if (Helpers::soNumero($min['tempoVolta']) >  Helpers::soNumero($volta['tempoVolta'])) {
                $min = $volta;
            }

            array_push($tempoProva, $volta['tempoVolta']);

            $velocidadeMediaVolta = floatval(str_replace(',', '.', $volta['velocidadeMedia']));
            $media = $media + $velocidadeMediaVolta;
        }

        $velMedia = $media / count($voltasPiloto);
        return $min;
    }

    private function calcularDiferenca($primeroValor, $segundoValor)
    {
        $primeroValor = str_replace(',', '.', str_replace(':', '', $primeroValor));
        $segundoValor = str_replace(',', '.', str_replace(':', '', $segundoValor));
        return floatval($primeroValor) - floatval($segundoValor);
    }
}
