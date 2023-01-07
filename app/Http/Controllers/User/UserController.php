<?php

namespace App\Http\Controllers\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
class UserController extends ApiController
{



    use ApiResponser;
    /**
     *
     * @var UserService
     */
    public $UserService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(UserService $UserService)
    {
        parent::__construct();   
        $this->UserService = $UserService;
        $this->middleware('client.credentials')->only(['index','show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->successResponse($this->UserService->obtainUser('GET','users?',$request->all(),$request->all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->UserService->obtainUser('POST','users',$request->all(),[]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->UserService->obtainUser('GET','users/'.$id.'',[] ,[]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        return $this->successResponse($this->UserService->obtainUser('PUT','users/'.$id.'',$request->all(),[]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse($this->UserService->obtainUser('delete','users/'.$id.'',[] ,[]));
    }
}
