<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class HospitalService
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
    public function obtainHospital()
    {
        /**
         * variable temporal hasta que resuelva como recuperar el config 
         */
        
        $request = config('services.hospital.base_uri');
        return $this->performRequest('GET', $request, 'hospital',[],[]);
    }
}
