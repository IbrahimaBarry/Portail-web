<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        'name', 'articles',
    ];

    protected $events = [
        'updated' => Events\Notification::class
    ];

    public function themes()
    {
    	return $this->belongsToMany('App\Theme');
    }

    public function newsletters()
    {
        return $this->hasMany('App\Newsletter');
    }
}
