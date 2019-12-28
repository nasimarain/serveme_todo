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

class CategoryUtils extends BaseUtility {

    /**
     * registerUser method verify and store user data to database
     * @return type
     */
    public function postCategory() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->category_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'category_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        $category['name'] = $request_params['name'];
        $data = $this->getCategoryModel()->saveNewCategory($category);
        return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['category_success'], $data);
    }
}
