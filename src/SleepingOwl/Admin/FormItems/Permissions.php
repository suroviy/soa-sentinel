<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Permissions  extends NamedFormItem
{

	protected $view 				= 'permissions';
	protected $model				= 'SleepingOwl\Admin\Model\Permission';
	protected $withInherited		= false;
	protected $groupedPermissions	= false;

	public function value() 
	{
		$value = parent::value();
		return array_keys($value);
	}

	public function getAllPermissions() 
	{
		$repository = new BaseRepository($this->model());
		$model = $repository->query();		
		
		if( $this->groupedPermissions() ) 
		{
			$collection = $repository->model()->all()->groupBy(function ($item, $key) {
		    	return ( empty($item['group_name']) ) ? 'admin::lang.permission.without_group' : $item['group_name'];
			});
		} else {
			$collection = $repository->model()->all();
		}
		
		return $collection;
	}

	public function inherited()
	{
		$this->withInherited = true;
		return $this;
	}

	public function model($model = null)
	{
		if (is_null($model))
		{
			return $this->model;
		}
		$this->model = $model;
		return $this;
	}

	public function grouped() 
	{
		$this->groupedPermissions 	= true;
		$this->view 				= 'permissions_tab';
		return $this;
	}

	public function groupedPermissions()
	{
		return $this->groupedPermissions;
	}

	public function withInherited() 
	{
		return $this->withInherited;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'fieldname'					=> $this->name(),
			'permissions'				=> $this->instance()->permissions,
			'all_permissions'			=> $this->getAllPermissions(),
			'withInherited'				=> $this->withInherited(),
			'groupedPermissions'		=> $this->groupedPermissions()
		];
	}

    public function save()
	{
		$name = $this->name();

		//fetch the selected permissions from the temporary form field
		$input = \Request::all();

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