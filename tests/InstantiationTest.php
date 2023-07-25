<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Exceptions\URLNotFoundException;
use Rflex\Nominus;

final class InstantiationTest extends TestCase
{
    public function testInitNominus(): void
    {
        putenv('NOMINUS_URL=http://localhost.test');

        $bearerToken = 'testBearerToken';

        $nominus = new Nominus($bearerToken);

        $this->assertEquals($nominus->token, $bearerToken);
    }

    public function testInitNominusWithoutEnvironment(): void
    {
        $bearerToken = 'testBearerToken';
        $holdingUUID = 'testHoldingUUID';

        $this->expectException(URLNotFoundException::class);

        new Nominus($bearerToken, $holdingUUID);
    }

    public function testInitNominusWithHoldingUuid(): void
    {
        putenv('NOMINUS_URL=http://localhost.test');

        $bearerToken = 'testBearerToken';
        $holdingUUID = 'testHoldingUUID';

        $nominus = new Nominus($bearerToken, $holdingUUID);

        $this->assertEquals($nominus->token, $bearerToken);
        $this->assertEquals($nominus->holdingUUID, $holdingUUID);

        $this->assertNotNull($nominus->holding);
        $this->assertNotNull($nominus->holding->branch);
        $this->assertNotNull($nominus->holding->organization);
        $this->assertNotNull($nominus->holding->organization->area);
        $this->assertNotNull($nominus->holding->organization->company);
    }
}
