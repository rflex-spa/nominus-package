<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Nominus;
use GuzzleHttp\Client;

final class HoldingTest extends TestCase
{
    public function testHoldings(): void
    {
        $bearerToken = $this->login();

        putenv('NOMINUS_URL=http://localhost:8011');
        $nominus = new Nominus($bearerToken);

        $this->assertEquals($nominus->token, $bearerToken);
    }

    public function testCurrentHolding(): void
    {
        $bearerToken = $this->login();
        $holdingUUID = '7d60a8e1-8982-4a12-982b-affe49cd6c7d';

        putenv('NOMINUS_URL=http://localhost:8011');
        $nominus = new Nominus($bearerToken, $holdingUUID);

        $this->assertNotNull($nominus->holding);

        echo $nominus->holding->current();

        $this->assertEquals($nominus->holding->current(), $bearerToken);
    }

    public function login(): string
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8011/api/',
        ]);

        $response = $client->request('POST', 'auth/login', [
            'json' => [
                'email' => '',
                'password' => ''
            ]
        ]);

        return json_decode($response->getBody(), true)['data']['nominus']['jwt']['token'];
    }
}
