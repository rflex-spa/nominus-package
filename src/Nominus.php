<?php

namespace Rflex;

use Rflex\Entities\Holding;
use Rflex\Exceptions\TokenNotFoundException;
use Rflex\Exceptions\URLNotFoundException;

class Nominus
{
    public string|null $url = null;
    public string|null $token = null;

    public Holding $holding;

    public function __construct(int $holdingId)
    {
        if (env('NOMINUS_URL', false) !== false) {
            $this->url = env('NOMINUS_URL');
        } else {
            throw new URLNotFoundException;
        }

        if (env('NOMINUS_TOKEN', false) !== false) {
            $this->token = env('NOMINUS_TOKEN');
        } else {
            throw new TokenNotFoundException;
        }

        $this->holding = new Holding($this->token, $this->url, $holdingId);
    }
}
