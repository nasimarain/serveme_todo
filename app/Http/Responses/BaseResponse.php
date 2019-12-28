<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

use App\Http\Utilties\CommonUtils;
use App\Http\GlobalUtilties\ImageUtils;
use App\Http\GlobalUtilties\TimeCoversionUtils;
use App\Http\Utilties\MessageUtils;
use App\Http\Models\User;
use App\Http\Models\UserDevice;
use App\Http\Models\Category;
use App\Http\Models\Size;
use App\Http\Models\TripUserReview;
use App\Http\Models\Trip;
use App\Http\Models\NotificationSetting;
use App\Http\Responses\ImagesResponse;
use App\Http\Responses\UserResponse;

class BaseResponse {

    public function getCommonUtils() {
        return new CommonUtils();
    }

    public function getMessageUtil() {
        return new MessageUtils();
    }

    public function getImageUtils() {
        return new ImageUtils();
    }

    public function getUserModel() {
        return new User();
    }

    public function getUserDeviceModel() {
        return new UserDevice();
    }

    public function getTripUserReviewModel() {
        return new TripUserReview();
    }

    public function getTimeUtils() {
        return new TimeCoversionUtils();
    }

    /**
     * calculateTripRatting method
     * @param type $trip_id
     * @return type
     */
    public function calculateTripRatting($trip_id) {
        $rate = $this->getTripUserReviewModel()->calculateTripRattings($trip_id);
        return $rate;
    }

    /**
     * calculateCarrierRatting method
     * @param type $user_id
     * @return type
     */
    public function calculateCarrierRatting($user_id) {
        $check_vendor_eligibility = $this->getTripUserReviewModel()->calulateNoOfTrips($user_id);
        if ($check_vendor_eligibility >= 3) {
            $calculated_rattings = $this->getTripUserReviewModel()->calculateOwnerRattings($user_id);
        } else {
            $calculated_rattings = 0;
        }
        return $calculated_rattings;
    }

    public function getNotificationModel() {
        return new NotificationSetting();
    }

    public function getImagesResponse() {
        return new ImagesResponse();
    }

    public function getUserResponse() {
        return new UserResponse();
    }

    public function getCategoryModel() {
        return new Category();
    }

    public function getSizeModel() {
        return new Size();
    }

    public function getTripModel() {
        return new Trip();
    }

}
