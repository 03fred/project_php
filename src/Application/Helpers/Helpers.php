<?php

namespace App\Application\Helpers;

class Helpers
{

    public static function soLetra(string $str): string
    {
        return trim(preg_replace("/[^A-Za-z]/", " ", $str));
    }
}
