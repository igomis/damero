<?php

namespace Damero\Exempcions;

class PasswordDoNotMatchException extends  \Exception
{
    public function __construct($message = "Les contrasenyes no coincideixen", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
