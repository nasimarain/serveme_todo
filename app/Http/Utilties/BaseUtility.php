<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

use App\Http\Utilties\CommonUtils;
use App\Http\Utilties\RulesUtils;
use App\Http\Utilties\MessageUtils;
use App\User;
use App\Category;
use App\ToDoItems;

use App\Http\Responses\UserResponse;

class BaseUtility {

    function __construct() {
        
    }
    /**
     * 
     * SETTERS
     */
    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getRulesUtils() {
        return new RulesUtils();
    }

    public function getMessageUtils() {
        return new MessageUtils();
    }

    public function getUserModel() {
        return new User();
    }

    public function getCategoryModel() {
        return new Category();
    }

    public function gettoDoItemModel() {
        return new ToDoItems();
    }

    public function getUsersResponse() {
        return new UserResponse();
    }
}
