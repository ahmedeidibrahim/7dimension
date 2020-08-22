<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Table Name 
    protected $table = 'projects';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps =true;

    //relation
    public function program()
    {
        return $this->belongsTo('App\Program');
    }
    public function sub_projects()
    {
        return $this->hasMany('App\SubProject','project_id');
    }
}
