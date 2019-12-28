<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'mobile_number', 'user_token', 'gender', 'birthday'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    public function saveNewUser($inputs) {
        $user = new User($inputs);
        if ($user->save()) {
            return $user;
        }
        return false;
    }

    public function getUserByColumnValue($column, $value) {
        $data = $this->where($column, '=', $value)->first();
        return !empty($data) ? $data->toArray() : [];
    }

    public function updateUserByColumnValue($cloumn, $value, $data) {
        return $this->where($cloumn, '=', $value)->update($data);
    }
}
