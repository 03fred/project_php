<?php

namespace App\Application\DTO;

use JsonSerializable;

class VoltasDTO implements JsonSerializable
{
    private $pilotoVoltas;
    private $melhorVolta;
    private $tempo;
    private $nomePiloto;
    private $numeroVolta;
    private $tempoVolta;
    private $velocidadeMedia;
    private $velocidadeMediaTotal;
    private $tempoTotalProva;
    private $tempoAtrasPrimeiroColado;

    public function __construct(array $pilotosVoltas, array $melhorVolta)
    {
        $this->pilotoVoltas = $pilotosVoltas;
        $this->melhorVolta = $melhorVolta;
    }

    public function jsonSerialize()
    {
        return $this->formataVoltas();
    }

    private function formataVoltas()
    {
        $result = [];
        foreach ($this->pilotoVoltas as $voltas) {
          
            


        }

        return $result;
    }
}
