<?php namespace SleepingOwl\Admin\FormItems;

use SleepingOwl\Admin\AssetManager\AssetManager;

class Filemanager extends NamedFormItem{

	protected $view = 'filemanager';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/plugins/colorbox/colorbox.css');
		AssetManager::addScript('admin::default/plugins/colorbox/jquery.colorbox-min.js');
		AssetManager::addScript('admin::default/js/formitems/filemanager/filemanager.js');
	}

}