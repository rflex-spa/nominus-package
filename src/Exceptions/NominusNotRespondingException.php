<?php

namespace Rflex\Exceptions;

use Exception;

class NominusNotRespondingException extends Exception
{
    public function __construct()
    {
        $message = 'Nominus is not responding.';

        parent::__construct($message, 0, null);
    }
}
