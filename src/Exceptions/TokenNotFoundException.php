<?php

namespace Rflex\Exceptions;

use Exception;

class TokenNotFoundException extends Exception
{
    public function __construct()
    {
        $message = 'Token environment variable NOMINUS_TOKEN not found.';

        parent::__construct($message, 0, null);
    }
}
