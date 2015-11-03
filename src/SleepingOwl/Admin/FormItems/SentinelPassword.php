<?php namespace SleepingOwl\Admin\FormItems;

class SentinelPassword extends NamedFormItem
{

	protected $view = 'password';

	public function save()
	{
		$name = $this->name();
		if ( \Input::has($name) )
		{
			\Input::merge(array($name => password_hash($this->value(), PASSWORD_BCRYPT)));
			parent::save();
		}
	}
}