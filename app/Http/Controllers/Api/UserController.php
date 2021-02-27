<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\ApiController;
use App\Models\User;

class UserController extends ApiController
{
    public function profile()
    {
    	$userId = auth()->user()->id;
    	$user = User::whereId($userId)->first();
    	return $this->sendResponse(NULL, $user);
    }
}
