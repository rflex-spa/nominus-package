<?php

namespace RFlex;

use Illuminate\Http\Client\Response;

class Helpers
{
    /**
     * Check for a successful response if not, throws a client/server error exception.
     */
    public static function returnOrException(Response $response): object|array
    {
        if ($response->successful() === true) {
            return $response->object();
        }

        $response->throw();
    }
}
