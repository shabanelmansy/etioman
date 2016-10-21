<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        # code...
       return $this->hasMany('App\Article');
    }

    public function courses()
    {
        # code...
       return $this->hasMany('App\Course');
    }


    public function students()
    {
        # code...
       return $this->hasMany('App\Student');
    }

    public function roles()
    {
        # code...
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    public function hasAnyRole($roles)
    {
        # code...
        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }

        }else{

            if($this->hasRole($roles))
            {
                return true;
            }
        }
    }


    public function hasRole($role)
    {
        # code...
        if($this->roles()->where('name',$role)->first()){
            return true;
        }

        return false;
    }

}
