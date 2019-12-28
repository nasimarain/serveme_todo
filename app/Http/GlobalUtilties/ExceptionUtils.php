<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\GlobalUtilties;

use App\Http\Utilties\BaseUtility;
use App\CodeExceptions;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
class ExceptionUtils extends BaseUtility {

    public function getCodeExceptionModel() {
        return new CodeExceptions();
    }

    /**
     * storeException method
     * @param type $ex
     */
    public function storeException($ex) {
        self::saveExceptionInDatabase($ex);
        return $this->getCommonUtils()->jsonErrorResponse($this->getMessageUtils()->getMessageData('error', !empty($inputs['lang']) ? $inputs['lang'] : 'EN')['general_error']);
    }

    /**
     * saveExceptionInDatabase method
     * @param type $ex
     */
    public function saveExceptionInDatabase($ex) {
        DB::rollback();
        // $exception['user_id'] = (Session::has('current_user')) ? Session::get('current_user')->id : 0;
        $exception['exception_file'] = $ex->getFile();
        $exception['exception_line'] = $ex->getLine();
        $exception['exception_message'] = $ex->getMessage();
        $exception['exception_url'] = Request::url();
        $exception['exception_code'] = $ex->getCode();
        $this->getCodeExceptionModel()->saveException($exception);
    }

}
