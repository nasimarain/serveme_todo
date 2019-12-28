<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

class RulesUtils {

    /**
     * This method select appropriate messages and language for messages 
     *
     * @return $messages
     */
    public function selectLanguageForMessages($rules, $language = 'EN') {
        if (isset($rules) && !empty($language)) {
            $messages_type = $rules . '_' . strtolower($language);
            $messages = self::${$messages_type};
            return $messages;
        }
    }

    /**
     * Login rules and their translation goes here.
     *
     * 
     */
    public $login_rules = [
        'email' => 'required',
        'password' => 'required|min:8',
    ];
    public static $login_rules_en = [
        'email.required' => 'email field is required',
        'password.required' => 'password field is required',
        'password.min' => 'password should contain at least 8 characters',
    ];

    /**
     * unique user phone  rules and their translation goes here.
     *
     */
    public $unique_phone_rules = [
        'phone_no' => 'required',
    ];
    public static $unique_phone_rules_en = [
        'phone_no.required' => 'phone number field is required',
    ];

    /**
     * register_user_rules_with_email and their translation goes here.
     *
     */
    public $register_user_rules_with_email = [
        'first_name' => 'required',
        'last_name' => 'required',
        'password' => 'required|min:8',
        'email' => 'required|email',
        'mobile_number' => 'required',
        'gender' => 'required',
        'birthday' => 'required',
    ];

    public $category_rules = [
        'name' => 'required',
    ];

    public $todo_items_rules = [
        'name' => 'required',
        'description' => 'required',
        'date' => 'required',
        'status' => 'required',
        'category_id' => 'required',
        'user_id' => 'required',
    ];

    public static $rules_email = [
        'email' => 'required|email',
    ];

    public static $category_rules_en = [
        'name.required' => 'name field is required',
    ];

    public static $todo_items_rules_en = [
        'name.required' => 'name field is required',
        'description.required' => 'description field is required',
        'date.required' => 'date field is required',
        'status.required' => 'status field is required',
        'category_id.required' => 'category_id field is required',
        'user_id.required' => 'user_id field is required',
    ];

    public static $register_user_rules_with_email_en = [
        'first_name.required' => 'first name field is required',
        'last_name.required' => 'last name field is required',
        'password.required' => 'password field is required',
        'password.min' => 'password should contains atleast 8 letter',
        'mobile_number.required' => 'mobile number field is required',
        'email.required' => 'email field is required',
        'email.unique' => 'this email has already been taken',
        'email.email' => 'email format is invalid',
        'gender.required' => 'gender field is required',
        'birthday.required' => 'birthday field is required',
    ];

    /**
     * forgot password  rules and their translation goes here.
     *
     */
    public $forgot_password_rules = [
        'recovery_type' => 'required|in:Email,Phone',
        'user_role_id' => 'required|in:2'
    ];
    public static $forgot_password_rules_en = [
        'recovery_type.required' => 'recovery type feild is required',
        'recovery_type.in' => 'recovery type should be email or phone',
        'user_role_id.required' => 'role field is required',
        'user_role_id.in' => 'selected role is not valid'
    ];
    /**
     * update password  rules  and their translation goes here.
     *
     */
    public $update_password_rules = [
        'reset_code' => 'required',
        'password' => 'required|',
    ];
    public static $update_password_rules_en = [
        'reset_code.required' => 'reset code field is required',
        'password.required' => 'password field is required',
    ];
    /**
     * update password  rules  and their translation goes here.
     *
     */
    public $edit_password_rules = [
        'old_password' => 'required',
        'new_password' => 'required',
    ];
    public static $edit_password_rules_en = [
        'old_password.required' => 'old password field is required',
        'new_password.required' => 'new password field is required',
    ];
    
}
