<?php

namespace SabreLaravel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use SabreLaravel\Exceptions\SabreException;

class SabreClient
{
    protected Client $http;
    protected string $baseUrl;

    public function __construct()
    {
        $environment = config('sabre.environment', 'test');
        $this->baseUrl = config("sabre.endpoints.{$environment}");

        $this->http = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 30,
            'headers'  => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function post(string $uri, array $options = []): array
    {
        try {
            $response = $this->http->post($uri, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $body = $e->hasResponse()
                ? json_decode($e->getResponse()->getBody()->getContents(), true)
                : [];
            throw new SabreException(
                $body['error_description'] ?? $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function get(string $uri, array $options = []): array
    {
        try {
            $response = $this->http->get($uri, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $body = $e->hasResponse()
                ? json_decode($e->getResponse()->getBody()->getContents(), true)
                : [];
            throw new SabreException(
                $body['error_description'] ?? $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
