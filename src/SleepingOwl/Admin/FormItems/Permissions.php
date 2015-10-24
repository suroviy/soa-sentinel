<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\Model\Permission as PermissionModel;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Permissions  extends NamedFormItem
{

	protected $view 			= 'permissions';
	protected $withInherited	= false;

	public function value() {
		$value = parent::value();
		return array_keys($value);
	}

	public function getAllPermissions() {
		return PermissionModel::all();	
	}

	public function inherited()
	{
		$this->withInherited = true;
		return $this;
	}

	public function withInherited() {
		return $this->withInherited;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'fieldname'			=> $this->name(),
			'permissions'		=> $this->instance()->permissions,
			'all_permissions'	=> $this->getAllPermissions(),
			'withInherited'		=> $this->withInherited()
			
		];
	}

    public function save()
	{
		$name = $this->name();

		//fetch the selected permissions from the temporary form field
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
	 		
	 		if( $value == 1) {
	 			$this->instance()->addPermission($key);
	 		}
	 		if( $value == 0) {
	 			$this->instance()->addPermission($key, false);
	 		}
	 	}

	}
}