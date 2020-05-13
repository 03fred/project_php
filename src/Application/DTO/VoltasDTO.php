<?php

namespace App\Application\DTO;

use JsonSerializable;

class VoltasDTO implements JsonSerializable
{
    private $pilotoVoltas;

    public function __construct(array $pilotosVoltas)
    {
        $this->pilotoVoltas = $pilotosVoltas;
    }

    public function jsonSerialize()
    {
        return $this->formataVoltas();
    }

    private function formataVoltas()
    {
        foreach ($this->pilotoVoltas as $indice => $volta) {
           
        }
    }
}
