<?php

namespace Rflex;

use \Psr\Http\Message\ResponseInterface;
use Rflex\Exceptions\NominusNotRespondingException;

class Helpers
{
    /**
     * Check for a successful response if not, throws a client/server error exception.
     */
    public static function checkResponse(ResponseInterface $response): object|array
    {
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return json_decode($response->getBody(), true)['data'];
        }

        return throw new NominusNotRespondingException;
    }
}
