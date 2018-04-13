<?php
/**
 * Wrapper class for the CarMD App service.
 *
 * @author: Cuesta
 */

namespace App\AutoTelematic;
use App\AutoTelematic\models\{Message, DecodeData};
use GuzzleHttp\Client;

class AutoTelematic
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => env('AUTOAPI_URL'),
            'timeout' => 2.0,
            'headers'  => [
                "Authorization" => str_replace("_", " ", env('AUTOAPI_AUTH')),
                "partner-token" => env('AUTOAPI_TOKEN'),
                "Content-Type" => "application/json"
            ]
        ]);
    }

    public function decode(string $vin) {
        $response = $this->_client->get('decode?vin=' . $vin);
        $response = $response->getBody();
        return $response;
    }
}