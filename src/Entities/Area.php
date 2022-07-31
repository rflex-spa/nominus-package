<?php

namespace Rflex\Entities;

use Illuminate\Support\Facades\Http;
use Rflex\Constants\URL;
use Rflex\Helpers;

class Area
{
    public function __construct(string $token, string $url, string $holdingUUID)
    {
        $this->token = $token;
        $this->url = $url;
        $this->holdingUUID = $holdingUUID;
    }

    public function getById(int $organizationId, int $areaId): object
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::AREAS.'/'.$areaId, [
            'holding' => $this->holdingUUID,
            'organization_id' => $organizationId,
        ]));
    }

    public function getByIds(int $organizationId, array $areaIds): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::AREAS, [
            'holding' => $this->holdingUUID,
            'organization_id' => $organizationId,
            'areas_ids' => $areaIds,
        ]));
    }

    public function branches(int $organizationId, int $areaId): array
    {
        return Helpers::returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::AREAS.'/'.$areaId.'/branches', [
            'holding' => $this->holdingUUID,
            'organization_id' => $organizationId,
        ]));
    }
}
