<?php

namespace App\Http\Controllers\Shipping;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class DHLController extends Controller
{
    public function getRates()
    {
        $url = env('DHL_BASE_URL');
        $curl = curl_init();
        // Generate the Basic Auth string
        $authString = $this->auth();
        $data = [
            "customerDetails" => [
                "shipperDetails" => [
                    "postalCode" => "14800",
                    "cityName" => "Prague",
                    "countryCode" => "CZ",
                    "provinceCode" => "CZ",
                    "addressLine1" => "addres1",
                    "addressLine2" => "addres2",
                    "addressLine3" => "addres3",
                    "countyName" => "Central Bohemia"
                ],
                "receiverDetails" => [
                    "postalCode" => "14800",
                    "cityName" => "Prague",
                    "countryCode" => "CZ",
                    "provinceCode" => "CZ",
                    "addressLine1" => "addres1",
                    "addressLine2" => "addres2",
                    "addressLine3" => "addres3",
                    "countyName" => "Central Bohemia"
                ]
            ],
            "accounts" => [
                [
                    "typeCode" => "shipper",
                    "number" => "123456789"
                ]
            ],
            "productCode" => "P",
            "localProductCode" => "P",
            "valueAddedServices" => [
                [
                    "serviceCode" => "II",
                    "localServiceCode" => "II",
                    "value" => 100,
                    "currency" => "GBP",
                    "method" => "cash"
                ]
            ],
            "productsAndServices" => [
                [
                    "productCode" => "P",
                    "localProductCode" => "P",
                    "valueAddedServices" => [
                        [
                            "serviceCode" => "II",
                            "localServiceCode" => "II",
                            "value" => 100,
                            "currency" => "GBP",
                            "method" => "cash"
                        ]
                    ]
                ]
            ],
            "payerCountryCode" => "CZ",
            "plannedShippingDateAndTime" => "2020-03-24T13:00:00GMT+00:00",
            "unitOfMeasurement" => "metric",
            "isCustomsDeclarable" => false,
            "monetaryAmount" => [
                [
                    "typeCode" => "declaredValue",
                    "value" => 100,
                    "currency" => "CZK"
                ]
            ],
            "requestAllValueAddedServices" => false,
            "estimatedDeliveryDate" => [
                "isRequested" => false,
                "typeCode" => "QDDC"
            ],
            "getAdditionalInformation" => [
                [
                    "typeCode" => "allValueAddedServices",
                    "isRequested" => true
                ]
            ],
            "returnStandardProductsOnly" => false,
            "nextBusinessDay" => false,
            "productTypeCode" => "all",
            "packages" => [
                [
                    "typeCode" => "3BX",
                    "weight" => 10.5,
                    "dimensions" => [
                        "length" => 25,
                        "width" => 35,
                        "height" => 15
                    ]
                ]
            ]
        ];

        // Convert the data array to a JSON string
        $jsonData = json_encode($data);
dd([
    "Authorization: Basic ".$this->auth(),
    "Message-Reference: unique-request-id-5".time(),  // Unique ID for this request
    "Message-Reference-Date: " . gmdate('Y-m-d\TH:i:s\Z'),  // Current UTC date/time in ISO 8601 format
    "Plugin-Name: DHLIntegrationPlugin",  // Name of your plugin or system
    "Plugin-Version: 1.2.3",  // Version of your plugin or system
    "Shipping-System-Platform-Name: CustomShippingSystem",  // Your shipping system name
    "Shipping-System-Platform-Version: 4.5.1",  // Version of your shipping system
    "Webstore-Platform-Name: MyWebStore",  // Name of your web store platform
    "Webstore-Platform-Version: 2.8.9",  // Version of your web store platform
    "Content-Type: application/json"  // Content-Type header indicating JSON payload
]);
        curl_setopt_array($curl, [
            CURLOPT_URL => $url."/rates",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic ".$this->auth(),
                "Message-Reference: unique-request-id-5".time(),  // Unique ID for this request
                "Message-Reference-Date: " . gmdate('Y-m-d\TH:i:s\Z'),  // Current UTC date/time in ISO 8601 format
                "Plugin-Name: DHLIntegrationPlugin",  // Name of your plugin or system
                "Plugin-Version: 1.2.3",  // Version of your plugin or system
                "Shipping-System-Platform-Name: CustomShippingSystem",  // Your shipping system name
                "Shipping-System-Platform-Version: 4.5.1",  // Version of your shipping system
                "Webstore-Platform-Name: MyWebStore",  // Name of your web store platform
                "Webstore-Platform-Version: 2.8.9",  // Version of your web store platform
                "Content-Type: application/json"  // Content-Type header indicating JSON payload
            ]
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

    }
    private function auth(){
        $username = env('DHL_USERNAME');  
        $password = env('DHL_PASSWORD');  
        return base64_encode("$username:$password");
    }
}
