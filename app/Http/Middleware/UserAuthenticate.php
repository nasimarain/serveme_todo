<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Http\Models\User;

class UserAuthenticate {

    public function getUserModel() {
        return new User();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        try {
            $headers = apache_request_headers();
            $api_key = config('app.key');
            $key = explode(':', $api_key);
            if (empty($headers['USERTOKEN'])) {
                return UserApiAuthenticate::jsonErrorResponse('authorized requests only');
            }
            $user_token = $headers['USERTOKEN'];
            if (!empty($headers['APIKEY'])) {
                $APP_KEY = $headers['APIKEY'];
                if (!isset($APP_KEY) && empty($APP_KEY)) {
                    return UserApiAuthenticate::jsonErrorResponse('API key is required.');
                }
                if ($key[1] != $APP_KEY) {
                    return UserApiAuthenticate::jsonErrorResponse('Invalid API key');
                }
            } else {
                return UserApiAuthenticate::jsonErrorResponse('Authorized request only');
            }
            if (config('paths.current_api_version') != config('paths.update_api_version')) {
                return UserApiAuthenticate::jsonErrorResponse('update version');
            }
            $app_version = config('paths.app_version');
            if (!in_array($headers['VERSION'], $app_version)) {
                return UserApiAuthenticate::jsonErrorResponse('update version');
            }
            !empty($headers['LANG']) ? $request->merge(['lang' => $headers['LANG']]) : $request->merge(['lang' => 'EN']);
            $lang = !empty($headers['LANG']) ? $headers['LANG'] : 'EN';
            $user = $this->getUserModel()->getUserByColumnValue('user_token', $user_token);
            if (!empty($user)) {
                if ($user['is_archive'] == 1) {
                    return UserApiAuthenticate::jsonErrorResponse('Your account has been suspended. Please contact holistic admin.');
                }
            } else {
                return UserApiAuthenticate::jsonErrorResponse('Oops, it seems that you are logged in from another device.');
            }
            $request->merge(['user_token' => $user_token]);
            return $next($request);
        } catch (\Exception $ex) {
            return UserApiAuthenticate::jsonErrorResponse($ex->getMessage());
        }
    }

}
