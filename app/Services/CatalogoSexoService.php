<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class CatalogoSexoService
{
    use ConsumesExternalService;

    /**
     * base url del servicio de autores que se va a consumir este es el que envia la peticion al servicio correspondiente
     * @var string
     */

    public $baseUri;

    public function _construct()
    {

        $this->baseUri = config('services.catalogo.base_uri');
    }

    /**
     * base url del servicio de autores que se va a consumir
     * @return string
     */
    public function obtainCatalogoSexo()
    {
        /**
         * variable temporal hasta que resuelva como recuperar el config 
         */
        $request = env('CATALOGOS_SERVICE_BASE_URL');
        return $this->performRequest('GET', $request, 'catalogosexo');
    }
}
