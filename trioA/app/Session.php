<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    // Table Name 
    protected $table = 'sessions';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps =true;

    //relation
    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }
}
