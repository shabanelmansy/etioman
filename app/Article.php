<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Article extends Model
{
    //
    protected $table = 'articles';

    protected $fillable = [
    'title',
    'body',
    'published_at',
    'user_id'

    ];   

    protected $dates = ['published_at'];

    public function setPublishedAtAttribute($date)
    {
    	# code...
    	$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d' , $date);
    }
    

    public function scopePublished($query)
    {
    	# code...
    	//$query->where('published_at', '<=',Carbon::now());
    	$query->where('published_at', '>=',Carbon::now());
    }

    public function user()
    {
        # code...
        $this->belongsTo('App\User');
    }
}
