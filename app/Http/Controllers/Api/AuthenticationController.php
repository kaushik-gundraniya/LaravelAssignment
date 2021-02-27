<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\ApiController;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthenticationController extends ApiController
{
	//User registration
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password)
        ]);
 
        $token = $user->createToken('UserToken')->accessToken;
 
        return $this->sendResponse(trans('auth/authentication.register'), ['token' => $token]);
    }

    //User login
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => request()->email,
            'password' => request()->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('UserToken')->accessToken;
            return $this->sendResponse(trans('auth/authentication.login'), ['token' => $token]);
        } else {
            return $this->sendError(trans('auth/authentication.error'), [], 401);
        }
    }
}
