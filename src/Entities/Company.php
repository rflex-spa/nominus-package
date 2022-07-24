<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

class Company
{
    public function __construct(string $token, string $url, int $holdingId)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingId = $holdingId;
    }

    public function getById(int $organizationId, int $companyId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$companyId, [
            'holding_id' => $this->holdingId,
            'organization_id' => $organizationId,
        ]));
    }
}
