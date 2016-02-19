<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Dingo\Api\Routing\Helpers;

class AuthenticateController extends Controller
{

	use Helpers;

	public function __construct()
	{
		$this->middleware('jwt.auth', ['except' => ['authenticate']]);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

	    return $this->response->array($users->toArray());
    }

	public function authenticate(Request $request)
	{
		$credentials = $request->only('email', 'password');

		try{
			if (! $token = JWTAuth::attempt($credentials)){
				return response()->json(['error'=> '没有权限'], 401);
			}
		}catch( JWTException $e){
			return response()->json(['error' => '没有token'], 500);
		}

		return response()->json(compact('token'));
	}
}
