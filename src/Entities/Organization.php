<?php

namespace RFlex\Entities;

use Illuminate\Support\Facades\Http;
use RFlex\Constants\URL;
use RFlex\Helpers;

class Organization extends Holding
{
    public Area $area;
    public Company $company;

    public function __construct(string $token, string $url, int $holdingId)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingId = $holdingId;

        $this->area = new Area($this->token, $this->url, $holdingId);
        $this->company = new Company($this->token, $this->url, $holdingId);
    }

    public function getById(int $organizationId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId, ['holding_id' => $this->holdingId]));
    }

    public function getByCode(string $organizationCode): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/code/'.$organizationCode, ['holding_id' => $this->holdingId]));
    }

    public function companies(int $organizationId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/companies', ['holding_id' => $this->holdingId]));
    }

    public function areas(int $organizationId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/areas', ['holding_id' => $this->holdingId]));
    }

    public function products(int $organizationId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/products', ['holding_id' => $this->holdingId]));
    }

    public function productIntegrations(int $organizationId, int $productId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::ORGANIZATIONS.'/'.$organizationId.'/products/'.$productId.'/integrations', ['holding_id' => $this->holdingId]));
    }
}
