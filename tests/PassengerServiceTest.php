<?php

namespace SabreLaravel\Tests;

use PHPUnit\Framework\Attributes\Test;
use SabreLaravel\Auth\SabreAuthService;
use SabreLaravel\Passengers\PassengerService;
use SabreLaravel\SabreClient;

class PassengerServiceTest extends TestCase
{
    #[Test]
    public function it_can_instantiate_passenger_service(): void
    {
        $client  = $this->createStub(SabreClient::class);
        $auth    = $this->createStub(SabreAuthService::class);
        $service = new PassengerService($client, $auth);

        $this->assertInstanceOf(PassengerService::class, $service);
    }

    #[Test]
    public function it_calls_get_with_correct_pnr(): void
    {
        $pnr   = 'ABC123';
        $token = 'fake_token';

        $auth = $this->createStub(SabreAuthService::class);
        $auth->method('getToken')->willReturn($token);

        $expectedResponse = ['passengers' => [['name' => 'John Doe']]];

        $client = $this->createStub(SabreClient::class);
        $client->method('get')->willReturn($expectedResponse);

        $service = new PassengerService($client, $auth);
        $result  = $service->list($pnr);

        $this->assertEquals($expectedResponse, $result);
    }
}
