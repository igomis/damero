<?php

namespace Damero\Exempcions;

class InvalidEmailException extends  \Exception
{
    public function __construct($message = "Email Invàlid", $code = 0, \Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}
