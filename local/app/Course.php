<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Course extends Model
{
    //
     //
    protected $table = 'courses';

    protected $fillable = [
    'title',
    'venue',
    'instructor',
    'start_at',
    'end_at',
    'lanquage',
    'certificate',
    'duration',
    'organization',
    'org_name',
    'fees',
    'awarding_body'
    ];   


    public function students()
    {
        # code...
       return $this->hasMany('App\Student');
    }

}
