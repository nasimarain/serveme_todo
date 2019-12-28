<?php

namespace App\Http\Controllers;

use DB;

class ToDoItemController extends Controller {

    function __construct() {
        $this->middleware('auth_api');
    }
    /**
     * postCategory takes parameters name
     * @return type
     */
    public function postToDoItems() {
        try {
            return $this->gettoDoItemsUtils()->postToDoItems();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
