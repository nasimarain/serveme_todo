<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Utilties;

class MessageUtils extends BaseUtility {

    /**
     * This function selects message language and message type
     *
     */
    public function getMessageData($type, $lang = 'EN') {
        if ($lang == 'AR' && $type == 'error') {
            return $this->error_ar;
        }if ($lang == 'AR' && $type == 'success') {
            return $this->success_ar;
        }
        if ($lang == 'EN' && $type == 'error') {
            return $this->error_en;
        }if ($lang == 'EN' && $type == 'success') {
            return $this->success_en;
        }
    }

    public $success_en = [
        'general_success' => 'Process successfully processed.',
        'login_success' => 'You have logged-in successfully',
        'user_found' => 'User exist againts this phone number.',
        'signup_success' => 'You have signed up successfully.',
        'category_success' => 'You have signed up successfully.',
        'todo_success' => 'You have added to-do item successfully.',
        'reset_code_sent_to_email' => 'Reset code has been sent to your email.',
        'code_verification_success' => 'Reset code verified successfully.',
        'password_updated' => 'Your password has been updated successfully.',
        'logout' => 'You have logged-out successfully',
    ];
    
    /**
     * All the error messages with English translation goes here.
     *
     */
    public $error_en = [
        'general_error' => 'Sorry, something went wrong. We are working on getting this fixed as soon as we can',
        'invalid_login_details' => 'Please provide valid email and password',
        'user_not_found' => 'User does not exist against these details',
        'reset_code_expired' => 'Reset code has expired',
        'invalid_old_password' => "Your old password is incorrect.",
        'email_already_taken' => 'This email is already assosiated with another sender account.',

    ];
}
