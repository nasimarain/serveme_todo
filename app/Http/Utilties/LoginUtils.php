<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Class LoginUtils extends BaseUtility {

    /**
     * validateRequest request method validate the user request
     * @return type
     */
    public function loginUser() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->login_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'login_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        return $this->attemptLogin($request_params);
    }

    /**
     * attemptLogin method make attempt of login against credential
     * @param type $request_params
     * @return type
     */
    public function attemptLogin($request_params) {
        $credentials = ['email' => $request_params['email'], 'password' => $request_params['password'], 'user_token' => $request_params['user_token'] ];
        if (!Auth::user()) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['invalid_login_details']);
        }
        $user = Auth::user()->toArray();        
        $user_data = $this->processLogin($user, $request_params);
        $data['user'] = $this->getUsersResponse()->prepareUserResponse($user_data);
        return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['login_success'], $data);
    }

    /**
     * processLogin method
     * @param type $user
     * @param type $inputs
     * @param type $version
     * @return type
     */
    public function processLogin($user, $request_params) {    
        $login_status = $this->updateLoginStatus($user, $request_params);
        if ($login_status) {
            $user_data = $this->getUserModel()->getUserByColumnValue('id', $user['id']);
        }
        return $user_data;
    }

    /**
     * update geo-locations as user logs in to the system
     * @param type $request_params
     * @param type $user
     * @return type
     */

    public function updateLoginStatus($user, $request_params) {
        $info_arr = [];
        $info_arr['is_login'] = 1;
        $info_arr['user_token'] = Hash::make(time());
        return $this->getUserModel()->updateUserByColumnValue('id', $user['id'], $info_arr);
    }

    /**
     * logout method
     * @return type
     */
    public function logout() {
        $request_params = Request::all();
        $headers = apache_request_headers();
        if (isset($headers['USERTOKEN'])) {
            $user = $this->getUserModel()->getUserByColumnValue('user_token', $headers['USERTOKEN']);
            if (empty($user)) {
                return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['user_not_found']);
            }
            $info_arr['is_login'] = 0;
            $logout = $this->getUserModel()->updateUserByColumnValue('id', $user['id'], $info_arr);
        }
        $logout = true;
        if ($logout) {
            return $this->getCommonUtils()->jsonSuccessResponseWithoutData($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['logout']);
        }
    }

}
