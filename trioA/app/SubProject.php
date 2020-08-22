<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProject extends Model
{
    // Table Name 
    protected $table = 'sub_projects';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps =true;

    //relation
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function activities()
    {
        return $this->hasMany('App\Activity','sub_project_id');
    }
}
