<?php

namespace Damero\Exempcions;



class WeekPasswordException extends \Exception
{
    public function __construct(
        $message = "Contrasenya dèbil",
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
