<?php namespace SleepingOwl\Admin\FormItems;


use Illuminate\Http\Request;

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

	public function save(Request $request)
	{
		$name = $this->name();
		if ( $request->has($name))
		{
			if( $this->useSentinel() ) {
				$request->merge(array($name => password_hash($this->value(), PASSWORD_BCRYPT)));
				parent::save();		
			} else {
				parent::save();
			}
		}
	}
}