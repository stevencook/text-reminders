<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{

	protected $fillable = ['message', 'fires_at'];

	// Get the owner of this reminder
	public function user() {
		return $this->belongsTo('User');
	}
}
