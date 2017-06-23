<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'groupe_id', 'role_id', 'sous_groupe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groupe()
    {
        return $this->belongsTo('App\Groupe');
    }

    public function sousGroupe()
    {
        return $this->belongsTo('App\SousGroupe');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function newsletter() {
        return $this->hasOne('App\Newsletter');
    }
}
