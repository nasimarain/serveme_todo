<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Category extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function saveNewCategory($inputs) {
        $category = new Category($inputs);
        if ($category->save()) {
            return $category;
        }
        return false;
    }
}
