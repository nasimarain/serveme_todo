<?php

namespace App\Http\Controllers;

use DB;

class CategoryController extends Controller {

    function __construct() {
        $this->middleware('auth_api');
    }
    /**
     * postCategory takes parameters name
     * @return type
     */
    public function postCategory() {
        try {
            return $this->getCategoryUtils()->postCategory();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
