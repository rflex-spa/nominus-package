<?php

namespace Rflex;

use Rflex\Entities\Holding;
use Rflex\Exceptions\URLNotFoundException;

class Nominus
{
    public string|null $url = null;
    public string|null $token = null;
    public string|null $holdingUUID = null;

    public Holding $holding;

    public function __construct(string $token, string $holdingUUID)
    {
        if (env('NOMINUS_URL', false) !== false) {
            $this->url = env('NOMINUS_URL');
        } else {
            throw new URLNotFoundException;
        }

        $this->token = $token;
        $this->holdingUUID = $holdingUUID;

        $this->holding = new Holding($this->token, $this->url, $this->holdingUUID);
    }
}
