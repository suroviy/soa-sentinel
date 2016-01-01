<?php namespace SleepingOwl\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

	protected $fillable = [
		'value',
		'description',
		'group_name'
	];

} 