<?php

/**
 * archivo php con el que se hace la  conexion a otros servicios 
 */

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{

    /**
     * Envia respuesta de los servicios
     * @return string
     */

    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        try {
          
            $client = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => 10.0,
            ]);
            $response = $client->request($method, $requestUrl, ['query' => $formParams, 'form_params' => $formParams, 'headers' => $headers]);
            return $response->getBody()->getContents();
            
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            echo $e->getResponse()->getBody()->getContents(); 
        }
    }
}
