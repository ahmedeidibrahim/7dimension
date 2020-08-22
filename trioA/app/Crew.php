<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    // Table Name 
    protected $table = 'crews';
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
