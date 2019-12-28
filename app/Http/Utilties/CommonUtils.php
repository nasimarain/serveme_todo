<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Response;
use Mail;

class CommonUtils extends BaseUtility {
    /**
     * jsonErrorResponse method
     * @param type $error
     * @return error response
     */
    public function jsonErrorResponse($error) {
        $response = [];
        $response['success'] = false;
        $response['message'] = $error;
        return response()->json($response);
    }
    /**
     * jsonSuccessResponse method
     * @param type $msg
     * @param type $data
     * @return return success response with data
     */
    public function jsonSuccessResponse($msg, $data = array()) {
        $response = [];
        $response['success'] = true;
        $response['data'] = !empty($data) ? $data : [];
        $response['message'] = $msg;
        return response()->json($response);
    }
    /**
     * return success response without data 
     * @param type $msg
     * @return type
     */
    public function jsonSuccessResponseWithoutData($msg) {
        $response = [];
        $response['success'] = true;
        $response['message'] = $msg;
        return response()->json($response);
    }
}
