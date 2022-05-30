<?php

namespace RFlex\Entities;

use Illuminate\Support\Facades\Http;
use RFlex\Constants\URL;
use RFlex\Helpers;

class Area
{
    public function __construct(string $token, string $url, int $holdingId)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingId = $holdingId;
    }

    public function getById(int $organizationId, int $areaId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::AREAS.'/'.$areaId, [
            'holding_id' => $this->holdingId,
            'organization_id' => $organizationId,
        ]));
    }

    public function getByIds(int $organizationId, array $areaIds): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::AREAS, [
            'holding_id' => $this->holdingId,
            'organization_id' => $organizationId,
            'areas_ids' => $areaIds,
        ]));
    }

    public function branches(int $organizationId, int $areaId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::AREAS.'/'.$areaId.'/branches', [
            'holding_id' => $this->holdingId,
            'organization_id' => $organizationId,
        ]));
    }
}
