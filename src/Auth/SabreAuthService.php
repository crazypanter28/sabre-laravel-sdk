<?php

namespace SabreLaravel\Auth;

use Illuminate\Support\Facades\Cache;
use SabreLaravel\SabreClient;
use SabreLaravel\Exceptions\SabreException;

class SabreAuthService
{
    protected SabreClient $client;
    protected string $cacheKey = 'sabre_access_token';

    public function __construct(SabreClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get a valid token (from cache or fresh from Sabre).
     */
    public function getToken(): string
    {
        $minutes = config('sabre.token_cache_minutes', 8640);

        return Cache::remember($this->cacheKey, now()->addMinutes($minutes), function () {
            return $this->fetchToken();
        });
    }

    /**
     * Force a fresh token ignoring cache.
     */
    public function refreshToken(): string
    {
        Cache::forget($this->cacheKey);
        return $this->getToken();
    }

    /**
     * Request a new token from Sabre OAuth endpoint.
     */
    protected function fetchToken(): string
    {
        $clientId     = config('sabre.client_id');
        $clientSecret = config('sabre.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            throw new SabreException('Sabre credentials are not configured. Check SABRE_CLIENT_ID and SABRE_CLIENT_SECRET in your .env file.');
        }

        $credentials = base64_encode("{$clientId}:{$clientSecret}");

        $response = $this->client->post('/v2/auth/token', [
            'headers' => [
                'Authorization' => "Basic {$credentials}",
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        if (empty($response['access_token'])) {
            throw new SabreException('Failed to retrieve access token from Sabre.');
        }

        return $response['access_token'];
    }
}
