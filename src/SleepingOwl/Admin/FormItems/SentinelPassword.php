<?php namespace SleepingOwl\Admin\FormItems;


use Illuminate\Http\Request;

class SentinelPassword extends NamedFormItem
{

	protected $view = 'password';

	public function save(Request $request)
	{
		$name = $this->name();
		if ( $request->has($name) )
		{
			$request->merge(array($name => password_hash($this->value(), PASSWORD_BCRYPT)));
			parent::save();
		}
	}
}