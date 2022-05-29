<?php

namespace RFlex;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RFlex\Constants\URL;
use RFlex\Exceptions\TokenNotFoundException;
use RFlex\Exceptions\URLNotFoundException;

class Nominus
{
    private string $url;
    private string $token;
    private int $holdingId;

    public function __construct(int $holdingId)
    {
        $this->holdingId = $holdingId;

        if (env('NOMINUS_URL', false) !== false) {
            $this->url = env('NOMINUS_URL');
        } else {
            throw new URLNotFoundException;
        }

        if (env('NOMINUS_TOKEN', false) !== false) {
            $this->token = env('NOMINUS_TOKEN');
        } else {
            throw new TokenNotFoundException;
        }
    }

    /**
     * Retrieve the current holding.
     */
    public function getHolding(): object
    {
        return $this->returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingId));
    }

    public function getBranches(): array
    {
        return $this->returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingId.'/'.URL::BRANCHES));
    }

    public function getOrganizations(): array
    {
        return $this->returnOrException(Http::withToken($this->token)->get($this->url.'/'.URL::HOLDINGS.'/'.$this->holdingId.'/'.URL::ORGANIZATIONS));
    }

    public function getBranchAreas($branchId): array
    {
        return $this->returnOrException(Http::withToken($this->token)->post($this->url.'/'.URL::BRANCHES.'/'.$branchId.'/'.URL::AREAS, ['holding_id' => $this->holdingId]));
    }

    /**
     * Check for a successful response if not, throws a client/server error exception.
     */
    public function returnOrException(Response $response): object|array
    {
        if ($response->successful() === true) {
            return $response->object();
        }

        $response->throw();
    }
}
