<?php

namespace RFlex;

use Illuminate\Support\Facades\Http;

class Nominus
{
    protected string $url;

    public function __construct() {
        if (env('NOMINUS_URL', false) !== false && env('NOMINUS_URL') != '') {
            $this->url = env('NOMINUS_URL');
        }
        else {

        }
    }

    /**
     * Retrieve all holdings.
     */
    public function holdings(): object|null {
        $response = Http::get($this->url.'/holdings');
        return $response->object();
    }

    /**
     * Retrieve a holding by the id of it.
     */
    public function holdingById(int $id): object|null {
        $response = Http::get($this->url.'/holdings/'.$id);
        return $response->object();
    }
}
