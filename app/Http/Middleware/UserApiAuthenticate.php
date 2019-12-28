<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class UserApiAuthenticate {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        try {
            return self::verifyHeader($request, $next);
        } catch (\Exception $ex) {
            return self::jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * 
     * @return type
     */
    public static function verifyHeader($request, $next) {
        $headers = apache_request_headers();
        if (!empty($headers['APIKEY'])) {            
            $APP_KEY = $headers['APIKEY'];
            if (!isset($APP_KEY) && empty($APP_KEY)) {
                return self::jsonErrorResponse('API key is required.');
            }
            $api_key = env('APP_KEY');
            $key = explode(':', $api_key);
            if ($key[1] != $APP_KEY) {
                return self::jsonErrorResponse('Invalid API key');
            }
        } else {
            return self::jsonErrorResponse('Authorized request only');
        }
        !empty($headers['LANG']) ? $request->merge(['lang' => $headers['LANG']]) : $request->merge(['lang' => 'EN']);
        return $next($request);

    }

    /**
     * jsonErrorResponse method
     * @param type $error
     * @return error response
     */
    public static function jsonErrorResponse($error) {
        $response = array();
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
    public static function jsonSuccessResponse($msg, $data = array()) {
        $response = array();
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
        $response = array();
        $response['success'] = true;
        $response['message'] = $msg;
        return response()->json($response);
    }

}
