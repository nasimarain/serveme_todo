<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Utilties\LoginUtils;
use App\Http\Utilties\CommonUtils;
use App\Http\Utilties\SignupUtils;
use App\Http\Utilties\CategoryUtils;
use App\Http\Utilties\ToDoItemsUtils;
use App\Http\GlobalUtilties\ExceptionUtils;


class Controller extends BaseController {

    // use AuthorizesRequests,
    //     DispatchesJobs,
    //     ValidatesRequests;

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getSignupUtils() {
        return new SignupUtils();
    }

    public function getCategoryUtils() {
        return new CategoryUtils();
    }

    public function gettoDoItemsUtils() {
        return new ToDoItemsUtils();
    }

    public function attempt() {
        return new LoginUtils();
    }

    public function getExceptionUtils() {
        return new ExceptionUtils();
    }
}
