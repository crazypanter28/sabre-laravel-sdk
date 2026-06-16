<?php

namespace SabreLaravel\Passengers;

use SabreLaravel\SabreClient;
use SabreLaravel\Auth\SabreAuthService;

class PassengerService
{
    protected SabreClient $client;
    protected SabreAuthService $auth;

    public function __construct(SabreClient $client, SabreAuthService $auth)
    {
        $this->client = $client;
        $this->auth   = $auth;
    }

    /**
     * Get passenger list for a given PNR.
     */
    public function list(string $pnr): array
    {
        $token = $this->auth->getToken();

        return $this->client->get("/v1/trip/orders/getPassengerDetails/{$pnr}", [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type'  => 'application/json',
            ],
        ]);
    }
}
