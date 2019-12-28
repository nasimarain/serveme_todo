<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

use App\Http\Responses\BaseResponse;

class UserResponse extends BaseResponse {

    public function prepareUserResponse($user) {
        $response = [];
        $response['id'] = $user['id'];
        $response['first_name'] = $user['first_name'];
        $response['last_name'] = $user['last_name'];
        $response['email'] = $user['email'];
        $response['mobile_number'] = $user['mobile_number'];
        $response['user_token'] = $user['user_token'];
        $response['gender'] = $user['gender'];
        $response['birthday'] = $user['birthday'];
        return $response;
    }
}
