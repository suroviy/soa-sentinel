<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Database\Eloquent\Collection;

class MultiSelect extends Select
{
	protected $multi = true;
	protected $plugin = 'choosen';
}
