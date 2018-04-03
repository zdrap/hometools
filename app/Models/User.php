<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $talbe = 'users';

	protected $fillable = [
		'email',
		'name',
		'password',
	];
}