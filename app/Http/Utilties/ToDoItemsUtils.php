<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;


class ToDoItemsUtils extends BaseUtility {

    /**
     * postToDoItems method verify and store items data to database
     * @return type
     */
    public function postToDoItems() {
        $request_params = Request::all();
        $validation = Validator::make($request_params, $this->getRulesUtils()->todo_items_rules, $this->getRulesUtils()->selectLanguageForMessages($rules = 'todo_items_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->getCommonUtils()->jsonErrorResponse($validation->errors()->first());
        }
        $category['name'] = $request_params['name'];
        $category['description'] = $request_params['description'];
        $category['date'] = $request_params['date'];
        $category['status'] = $request_params['status'];
        $category['category_id'] = $request_params['category_id'];
        $category['user_id'] = $request_params['user_id'];
        $data = $this->gettoDoItemModel()->saveNewtoDoItem($category);
        return $this->getCommonUtils()->jsonSuccessResponse($this->getMessageUtils()->getMessageData('success', $request_params['lang'])['todo_success'], $data);
    }
}
