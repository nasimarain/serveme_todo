<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class ToDoItems extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'todo_items';
    protected $fillable = ['name', 'description', 'date', 'status', 'category_id', 'user_id'];

    public function saveNewtoDoItem($inputs) {
        $todo = new ToDoItems($inputs);
        if ($todo->save()) {
            return $todo;
        }
        return false;
    }
}
