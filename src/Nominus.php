<?php

namespace Rflex;

use Rflex\Entities\Holding;
use Rflex\Exceptions\URLNotFoundException;
use GuzzleHttp\Client;
use Rflex\Constants\URL;
use stdClass;

class Nominus
{
    public string|null $url = null;
    public string|null $token = null;
    public string|null $holdingUUID = null;

    public Holding $holding;

    public function __construct(string $token, string $holdingUUID = null)
    {
        if (getenv('NOMINUS_URL') !== false) {
            $this->url = getenv('NOMINUS_URL');
        } else {
            throw new URLNotFoundException;
        }

        $this->token = $token;

        if (!is_null($holdingUUID)) {
            $this->holdingUUID = $holdingUUID;

            $this->holding = new Holding($this->token, $this->url, $this->holdingUUID);
        }
    }

    public function holdings(): stdClass
    {
        $client = new Client([
            'base_uri' => $this->url.'/api/',
        ]);

        $response = $client->request('GET', URL::HOLDINGS, [
            'headers' => [
                'Authorization' => 'Bearer '. $this->token
            ]
        ]);

        return json_decode($response->getBody());
    }
}
