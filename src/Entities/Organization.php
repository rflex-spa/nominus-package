<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

class Organization extends Holding
{
    public Area $area;
    public Company $company;

    public function __construct(string $token, string $url, string $holdingUUID)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingUUID = $holdingUUID;

        $this->area = new Area($this->token, $this->url, $this->holdingUUID);
        $this->company = new Company($this->token, $this->url, $this->holdingUUID);
    }

    public function getById(int $organizationId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId, ['holding' => $this->holdingUUID]));
    }

    public function getByCode(string $organizationCode): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/code/'.$organizationCode, ['holding' => $this->holdingUUID]));
    }

    public function companies(int $organizationId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/companies', ['holding' => $this->holdingUUID]));
    }

    public function areas(int $organizationId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/areas', ['holding' => $this->holdingUUID]));
    }

    public function products(int $organizationId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/products', ['holding' => $this->holdingUUID]));
    }

    public function productIntegrations(int $organizationId, int $productId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/products/'.$productId.'/integrations', ['holding' => $this->holdingUUID]));
    }
}
