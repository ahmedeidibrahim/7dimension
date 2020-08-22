<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // Table Name 
    protected $table = 'activities';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps =true;

    //relation
    public function sub_project()
    {
        return $this->belongsTo('App\SubProject');
    }
    public function sessions()
    {
        return $this->hasMany('App\Session','activity_id');
    }
    public function participants()
    {
        return $this->hasMany('App\Participant','activity_id');
    }
    public function crews()
    {
        return $this->hasMany('App\Crew','activity_id');
    }
    public function images()
    {
        return $this->hasMany('App\Image','activity_id');
    }
}
