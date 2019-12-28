<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SignupUtils extends BaseUtility {

    /**
     * registerUser method verify and store user data to database
     * @return type
     */
    public function registerUser() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->register_user_rules_with_email, $this->getRulesUtils()->selectLanguageForMessages($rules = 'register_user_rules_with_email', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        $check_user = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
        if (!empty($check_user)) {
            return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData($type = 'error', $request_params['lang'])['email_already_taken']);
        }
        return $this->processSignup($request_params);
    }

    /**
     * processSignup method further takes the sign up request
     * @param type $request_params
     * @return type
     */
    public function processSignup($request_params) {
        DB::beginTransaction();
        $save_user = $this->processUserData($request_params);
        if ($save_user) {
            $user = $this->getUserModel()->getUserByColumnValue('id', $save_user->id);
                DB::commit();
                $data['user'] = $this->getUsersResponse()->prepareUserResponse($this->getUserModel()->getUserByColumnValue('id', $user['id']));
                return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['signup_success'], $data);
        }
        DB::rollBack();
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', $request_params['lang'])['general_error']);
    }

    public function processUserData($request_params) {
        $user['first_name'] = $request_params['first_name'];
        $user['last_name'] = $request_params['last_name'];
        $user['email'] = $request_params['email'];
        $user['password'] = Hash::make($request_params['password']);
        $user['mobile_number'] = $request_params['mobile_number'];
        $user['user_token'] = Hash::make($request_params['mobile_number'] . time());
        $user['gender'] = $request_params['gender'];
        $user['birthday'] = $request_params['birthday'];
        return $this->getUserModel()->saveNewUser($user);
    }
}
