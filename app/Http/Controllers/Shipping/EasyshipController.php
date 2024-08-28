<?php
namespace App\Http\Controllers\Shipping;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class EasyshipController extends Controller
{
    public function getRates()
    {
        $apiKey = env('EASYSHIP_API_KEY');
        $url = 'https://api.easyship.com/v2/rates';

        // Sample data for rates request with UAE addresses
        $data = [
            "origin_address" => [
                "line_1" => "123 Sheikh Zayed Road",
                "line_2" => "Office 202",
                "state" => "Dubai",
                "city" => "Dubai",
                "postal_code" => "00000",
                "country_alpha2" => "AE"
            ],
            "destination_address" => [
                "line_1" => "456 Al Maktoum Street",
                "line_2" => "Apartment 101",
                "state" => "Abu Dhabi",
                "city" => "Abu Dhabi",
                "postal_code" => "11111",
                "country_alpha2" => "AE"
            ],
            "output_currency" => "AED",
            "parcels" => [
                [
                    "items" => [
                        [
                            "description" => "Silk dress",
                            "category" => "fashion",
                            "sku" => "test01",
                            "quantity" => 2,
                            "dimensions" => [
                                "length" => 30,
                                "width" => 20,
                                "height" => 10
                            ],
                            "actual_weight" => 10,
                            "declared_currency" => "USD",
                            "declared_customs_value" => 20
                        ]
                    ]
                ]
            ]
        ];

        // Make the API request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        // Handle the response
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Failed to retrieve rates',
                'details' => $response->json()
            ], $response->status());
        }
    }
}
