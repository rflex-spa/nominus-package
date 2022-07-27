<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

class Holding
{
    private string $token;
    private string $url;
    private int $holdingId;

    public Branch $branch;
    public Organization $organization;

    public function __construct(string $token, string $url, int $holdingId)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingId = $holdingId;

        $this->branch = new Branch($this->token, $this->url, $holdingId);
        $this->organization = new Organization($this->token, $this->url, $holdingId);
    }

    /**
     * Retrieve the current holding.
     */
    public function current(): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingId));
    }

    public function branches(): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingId.'/'.URL::BRANCHES, ['holding_id' => $this->holdingId]));
    }

    public function organizations(): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingId.'/'.URL::ORGANIZATIONS));
    }
}
