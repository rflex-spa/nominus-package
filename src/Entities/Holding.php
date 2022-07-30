<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

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

        $this->branch = new Branch($this->token, $this->url, $holdingUUID);
        $this->organization = new Organization($this->token, $this->url, $holdingUUID);
    }

    public function __invoke(): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID));
    }

    /**
     * Retrieve the current holding.
     */
    public function current(): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID));
    }

    public function branches(): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID.'/'.URL::BRANCHES));
    }

    public function organizations(): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingUUID.'/'.URL::ORGANIZATIONS));
    }
}
