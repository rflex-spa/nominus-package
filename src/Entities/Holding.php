<?php

namespace Rflex\Entities;

use Rflex\Constants\URL;
use Rflex\Helpers;
use GuzzleHttp\Client;

class Holding
{
    private string $token;
    private string $url;
    private string $holdingUUID;

    public Branch $branch;
    public Organization $organization;

    public function __construct(string $token, string $url, string $holdingUUID)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingUUID = $holdingUUID;

        $this->branch = new Branch($this->token, $this->url, $this->holdingUUID);
        $this->organization = new Organization($this->token, $this->url, $this->holdingUUID);
    }

    /**
     * Retrieve the current holding.
     */
    /* public function current(): object
    {
        return Helpers::checkResponse((new Client(['base_uri' => $this->url.'/api/']))->request('GET', URL::HOLDINGS.'/'.$this->holdingUUID, [
            'headers' => [
                'Authorization' => 'Bearer '. $this->token
            ]
        ]));
    } */

    public function current(): object
    {
        $client = new Client(['base_uri' => $this->url.'/api/']);

        $response = $client->request('GET', URL::HOLDINGS.'/'.$this->holdingUUID, [
            'headers' => [
                'Authorization' => 'Bearer '. $this->token
            ]
        ]);

        return Helpers::checkResponse($response);
    }

    public function branches(): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID.'/'.URL::BRANCHES));
    }

    public function organizations(): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID.'/'.URL::ORGANIZATIONS));
    }

    public function info(): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID.'/'.URL::HOLDINGS_INFO));
    }
}
