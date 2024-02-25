<?php

namespace Damero\Exempcions;


class RequiredFieldException extends \Exception
{
    public function __construct($message = "Camp requerit", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
