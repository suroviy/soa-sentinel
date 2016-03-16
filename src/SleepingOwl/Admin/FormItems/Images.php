<?php namespace SleepingOwl\Admin\FormItems;

use Input;
use Illuminate\Http\Request;
use SleepingOwl\Admin\AssetManager\AssetManager;

class Images extends Image
{

	protected $view = 'images';

	public function initialize()
	{
		AssetManager::addScript('admin::default/scripts/image/init-multiple.js');
		AssetManager::addScript('admin::default/plugins/flow/flow.min.js');
		AssetManager::addScript('admin::default/plugins/sortable/Sortable.min.js');
		AssetManager::addScript('admin::default/plugins/sortable/sortable.jquery.binding.js');
		AssetManager::addStyle('admin::default/css/form-items/images.css');
	}

	public function save()
	{
		$name = $this->name();
		$value = \Request::input($name, '');
		if ( ! empty($value))
		{
			$value = explode(',', $value);
		} else
		{
			$value = [];
		}
		\Request::merge([$name => $value]);
		parent::save();
	}

	public function value()
	{
		$value = parent::value();
		if (is_null($value))
		{
			$value = [];
		}
		if (is_string($value))
		{
			$value = preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
		}
		return $value;
	}

}