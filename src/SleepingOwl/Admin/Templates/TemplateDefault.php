<?php namespace SleepingOwl\Admin\Templates;

use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Interfaces\TemplateInterface;

class TemplateDefault implements TemplateInterface
{

	function __construct()
	{
		AssetManager::addStyle('admin::default/css/font-awesome.min.css');
		AssetManager::addStyle('admin::default/bootstrap/css/bootstrap.min.css');
		AssetManager::addStyle('admin::default/css/AdminLTE.min.css');
		AssetManager::addStyle('admin::default/css/_all-skins.min.css');
		AssetManager::addStyle('admin::default/css/custom.css');
		AssetManager::addStyle('admin::default/css/dataTables.bootstrap.css');
		AssetManager::addStyle('admin::default/plugins/iCheck/all.css');
		AssetManager::addStyle('admin::default/css/required_field.css');


		AssetManager::addScript(route('admin.lang'));
		AssetManager::addScript('admin::default/js/jquery-1.11.0.js');
		AssetManager::addScript('admin::default/bootstrap/js/bootstrap.min.js');
		AssetManager::addScript('admin::default/js/app.js');
		AssetManager::addScript('admin::default/js/admin.js');
		AssetManager::addScript('admin::default/plugins/iCheck/icheck.min.js');
		AssetManager::addScript('admin::default/js/required_field.js');

	}

	public function view($view)
	{
		$currentView = 'admin-lte::default.' . $view;
		if (\View::exists($currentView))
		{
			return $currentView;
		}
		return 'admin::default.' . $view;
	}

}