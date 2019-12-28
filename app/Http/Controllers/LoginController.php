<?php

namespace App\Http\Controllers;

class LoginController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }
    /**
     * doLogin method
     * @return type
     */
    public function doLogin() {
        try {
            return $this->attempt()->loginUser();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }
    /**
     * logout method
     * @return type
     */
    public function logout() {
        try {
            return $this->attempt()->logout();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        }
    }
}
