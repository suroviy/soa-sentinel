<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Permissions extends Chosen
{
	protected $multi=true;

	public function value() {
		$value = parent::value();
		return array_keys($value);
	}

    public function save()
	{
		$name = $this->name();

		//fetch the selected roles from the temporary form field
		$input = \Input::all();

		$selected_permissions = array_get($input, $name);
		if( $selected_permissions === null ) {
			$selected_permissions = [];
		}
		
		//remove all permissions
		foreach ($this->instance()->permissions as $key => $value) {
			$this->instance()->removePermission($key);
		}

		//add only the new selected
 		foreach ($selected_permissions as $key => $value) {
	 		$this->instance()->addPermission($value);
	 	}

	}
}