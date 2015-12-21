<?php namespace SleepingOwl\Admin\FormItems;

use Input;
use Illuminate\Http\Request;

class Checkbox extends NamedFormItem
{

	protected $view = 'checkbox';

	public function save(Request $request)
	{
		$name = $this->name();
		if ( ! $request->has($name))
		{
			$request->merge([$name => 0]);
		}
		parent::save();
	}


}