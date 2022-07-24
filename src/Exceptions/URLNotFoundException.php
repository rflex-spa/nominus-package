<?php

namespace Rflex\Exceptions;

use Exception;

class URLNotFoundException extends Exception
{
    public function __construct()
    {
        $message = 'URL environment variable NOMINUS_URL not found.';

        parent::__construct($message, 0, null);
    }
}
