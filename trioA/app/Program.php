<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    // Table Name
    protected $table = 'programs';
    // Primary Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps =true;

    //relation
    public function projects()
    {
        return $this->hasMany('App\Project','program_id');
    }
}
