<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Roles extends Chosen
{
	protected $multi	= true;
	protected $nullable = true;

    public function save()
	{
		$name = $this->name();

		//fetch the selected roles from the temporary
		//form field
		$input = \Request::all();
		$selected_roles = array_get($input, $name);
		if( $selected_roles === null ) {
			$selected_roles = [];
		}

		//remove all roles
		foreach ($this->instance()->roles->toArray() as $key => $value) {
			$role = \Sentinel::findRoleById($value['id']);
			$this->instance()->roles()->detach($role);
		}

		//add only the new selected
 		foreach ($selected_roles as $key => $id) {
	 		$role = \Sentinel::findRoleById($id);
	 		$this->instance()->roles()->attach($role);
	 	}
		 	
	}
}