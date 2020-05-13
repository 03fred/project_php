<?php

namespace App\Application\Helpers;

class Helpers
{

    public static function retiraNumeros(string $str): string
    {
        return preg_replace('/[0-9]+h/', '', $str);
    }
}
