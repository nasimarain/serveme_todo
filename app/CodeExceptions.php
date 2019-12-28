<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeExceptions extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'code_exceptions';
    protected $primarykey = 'id';
    protected $fillable = ['exception_file', 'exception_line', 'exception_message', 'exception_url', 'exception_code'];

    /**
     * The database functions goes here
     *
     * @var array
     */
    public function saveException($data) {
        $exception = new CodeExceptions($data);
        if ($exception->save()) {
            return $exception;
        }
    }

}
