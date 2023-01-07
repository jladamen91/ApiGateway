<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class UserService
{
    use ConsumesExternalService;

    /**
     * base url del servicio de autores que se va a consumir este es el que envia la peticion al servicio correspondiente
     * @var string
     */

    public $baseUri;

    public function _construct()
    {

        $this->baseUri = config('services.hospital.base_uri');
    }

    /**
     * base url del servicio de autores que se va a consumir
     * @return string
     */
    public function obtainUser($method,$endpoint,$data,$headers)
    {
        
        /**
         * variable temporal hasta que resuelva como recuperar el config 
         */
        $request = env('CATALOGOS_SERVICE_BASE_URL');
        $rutaEndPoint = $request.$endpoint;
       
        return $this->performRequest($method,$rutaEndPoint,$data,$headers);
    }
}
