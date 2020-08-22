<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // Table Name
    protected $table = 'permissions';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps =true;

    //relation
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
