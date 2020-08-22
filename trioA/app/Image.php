<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Table Name 
    protected $table = 'images';
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
