<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
	protected $fillable = ['user_id'];

	public function user() {
		return $this->belongsTo('App\User');
	}
}
