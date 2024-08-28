<?php
namespace App\Http\Services\Shipping;

use SoapClient;
use SoapFault;
class AramexService
{
    protected $soapClient;

    public function __construct()
    {
        // Path to the local WSDL file
        $wsdl = public_path('shipping/rate.wsdl');
        try {
            // Initialize SoapClient with local WSDL file
            $this->soapClient = new SoapClient($wsdl, ['trace' => 1]);
        } catch (\Exception $e) {
            throw new \Exception("Error initializing SoapClient: " . $e->getMessage());
        }
    }

    public function getRates()
    {
        $params = [
            'ClientInfo' => [
                'AccountCountryCode' => env('ARAMEX_ACCOUNT_COUNTRY_CODE'),
                'AccountEntity' => env('ARAMEX_ACCOUNT_ENTITY'),
                'AccountNumber' => env('ARAMEX_ACCOUNT_NUMBER'),
                'AccountPin' => env('ARAMEX_ACCOUNT_PIN'),
                'UserName' => env('ARAMEX_USERNAME'),
                'Password' => env('ARAMEX_PASSWORD'),
                'Version' => env('ARAMEX_VERSION'),
            ],
         
            'Transaction' => [
                'Reference1' => '001'
            ],
            'OriginAddress' => [
                'City' => 'Amman',
                'CountryCode' => 'JO'
            ],
            'DestinationAddress' => [
                'City' => 'Dubai',
                'CountryCode' => 'AE'
            ],
            'ShipmentDetails' => [
                'PaymentType' => 'P',
                'ProductGroup' => 'EXP',
                'ProductType' => 'PPX',
                'ActualWeight' => [
                    'Value' => 5,
                    'Unit' => 'KG'
                ],
                'ChargeableWeight' => [
                    'Value' => 5,
                    'Unit' => 'KG'
                ],
                'NumberOfPieces' => 5
            ]
        ];

        try {
            $results = $this->soapClient->CalculateRate($params);
            return $results;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}