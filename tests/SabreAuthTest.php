<?php

namespace SabreLaravel\Tests;

use PHPUnit\Framework\Attributes\Test;
use SabreLaravel\Auth\SabreAuthService;
use SabreLaravel\SabreClient;
use SabreLaravel\Exceptions\SabreException;

class SabreAuthTest extends TestCase
{
    #[Test]
    public function it_throws_exception_when_credentials_are_missing(): void
    {
        config(['sabre.client_id' => '', 'sabre.client_secret' => '']);

        $client  = $this->createStub(SabreClient::class);
        $service = new SabreAuthService($client);

        $this->expectException(SabreException::class);
        $this->expectExceptionMessage('Sabre credentials are not configured');

        $service->getToken();
    }

    #[Test]
    public function it_returns_token_from_cache(): void
    {
        cache(['sabre_access_token' => 'cached_token_123'], now()->addHour());

        $client  = $this->createStub(SabreClient::class);
        $service = new SabreAuthService($client);
        $token   = $service->getToken();

        $this->assertEquals('cached_token_123', $token);

        cache()->forget('sabre_access_token');
    }

    #[Test]
    public function it_can_instantiate_auth_service(): void
    {
        $client  = $this->createStub(SabreClient::class);
        $service = new SabreAuthService($client);

        $this->assertInstanceOf(SabreAuthService::class, $service);
    }
}
