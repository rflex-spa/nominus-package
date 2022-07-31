<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

class Company
{
    public function __construct(string $token, string $url, string $holdingUUID)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingUUID = $holdingUUID;
    }

    public function getById(int $organizationId, int $companyId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::COMPANIES.'/'.$companyId, [
            'holding' => $this->holdingUUID,
            'organization_id' => $organizationId,
        ]));
    }
}
