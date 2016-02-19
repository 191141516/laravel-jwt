<?php

namespace App\Api\Controllers;

use App\Api\Requests\UserRequest;
use Dingo\Api\Facade\API;
use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class AuthController extends BaseController
{
	public function me(Request $request)
	{
		return JWTAuth::parseToken()->authenticate();
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

	public function validateToken()
	{
		return API::response()->array(['status' => 'success'])->statusCode(200);
	}

	public function register(UserRequest $request)
	{
		$newUser = [
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => bcrypt($request->get('password')),
		];
		$user = User::create($newUser);
		$token = JWTAuth::fromUser($user);

		return response()->json(compact('token'));
	}
}
