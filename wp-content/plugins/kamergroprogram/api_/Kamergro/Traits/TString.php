<?php

namespace Kamergro\Traits;

/**
 * This trait has some string conversion functions
 */
trait TString
{
    function snakeToCamel($input, bool $startWithCapital = false)
    {
        $input = strtolower($input);
        $input = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
        if ($startWithCapital) {
            $input = ucfirst($input);
        }
        return $input;
    }

}