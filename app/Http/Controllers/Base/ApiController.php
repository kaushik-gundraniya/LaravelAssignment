<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseController;

class ApiController extends BaseController
{
    /**
     * Return json success response.
     *
     * @param  $message
     * @param  $result = []
     * @return \Illuminate\Http\Response
     */
    
 	public function sendResponse($message = '', $result = []){
		$response = [
            'status' => true,
            'message' => $message
        ];  
        //Bind data
        if($result){
            $response['data'] = $result;
        }
        return response()->json($response, 200);
    }

    /**
     * Return json error response.
     *
     * @param  $error
     * @param  $errorMessages = []
     * @return \Illuminate\Http\Response
     */

    public function sendError($error, $errorMessages = [], $code = 406){
    	$response = [
            'status' => false,
            'message' => $error,
        ];

		if($errorMessages){
            $response['errors'] = $errorMessages;
        }
		return response()->json($response, $code);
    }   
}
