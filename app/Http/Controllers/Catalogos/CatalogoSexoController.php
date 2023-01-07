<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Services\CatalogoSexoService;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\User\ApiController;

class CatalogoSexoController extends ApiController
{


    use ApiResponser;
    /**
     *
     * @var CatalogoSexoService
     */
    public $CatalogoSexoService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(CatalogoSexoService $CatalogoSexoService)
    {
        parent::__construct();   
             
        $this->CatalogoSexoService = $CatalogoSexoService;
        $this->middleware('client.credentials')->only(['index','show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return $this->successResponse($this->CatalogoSexoService->obtainCatalogoSexo());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
