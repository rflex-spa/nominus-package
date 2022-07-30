<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

class Branch
{
    public function __construct(string $token, string $url, string $holdingUUID)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingUUID = $holdingUUID;
    }

    public function getById(int $branchId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::BRANCHES.'/'.$branchId, ['holding_id' => $this->holdingUUID]));
    }

    public function areas(int $branchId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::BRANCHES.'/'.$branchId.'/'.URL::AREAS, ['holding_id' => $this->holdingUUID]));
    }
}
