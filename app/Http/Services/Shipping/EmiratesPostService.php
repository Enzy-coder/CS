<?php
namespace App\Http\Services\Shipping;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EmiratesPostService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('EMIRATESPOST_BASE_URL'),
            'headers' => [
                'Content-Type' => 'application/json',
                'AccountNo' => env('EMIRATESPOST_ACCOUNT_NO'),
                'Password' => env('EMIRATESPOST_PASSWORD'),
            ],
        ]);
    }

    public function calculateRate($data, $method = 'POST', $endpoint = '')
    {
        try {
            $response = $this->client->request($method, $endpoint, [
                'json' => [
                    'RateCalculationRequest' => $data
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $error = $e->getResponse()->getBody()->getContents();
                return json_decode($error, true);
            }
            return ['error' => $e->getMessage()];
        }
    }
}
