<?php namespace SleepingOwl\Admin\FormItems;

class Password extends NamedFormItem
{

	protected $view = 'password';
	protected $useSentinel = false;

	public function sentinel()
	{
		$this->useSentinel = true;
		return $this;
	}

	public function useSentinel()
	{
		return $this->useSentinel;
	}

	public function save()
	{
		$name = $this->name();
		if ( \Input::has($name))
		{
			if( $this->useSentinel() ) {
				\Input::merge(array($name => password_hash($this->value(), PASSWORD_BCRYPT)));
				parent::save();		
			} else {
				parent::save();
			}	
		} 
	}
}