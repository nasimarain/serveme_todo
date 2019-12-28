<?php

namespace App\Http\Controllers;

use DB;

class SignupController extends Controller {

    function __construct() {
        $this->middleware('auth_api');
    }
    /**
     * registerUser takes parameters and sign up a user
     * @return type
     */
    public function registerUser() {
        try {
            return $this->getSignupUtils()->registerUser();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->getExceptionUtils()->storeException($ex);
        } catch (\Exception $ex) {

            return $this->getExceptionUtils()->storeException($ex);
        }
    }

}
