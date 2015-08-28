<?php namespace SleepingOwl\Admin\Templates;

use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Interfaces\TemplateInterface;

class TemplateDefault implements TemplateInterface
{

	function __construct()
	{
		AssetManager::addStyle('admin::default/bootstrap/css/bootstrap.min.css');
		AssetManager::addStyle('admin::default/font-awesome-4.4.0/css/font-awesome.min.css');
		AssetManager::addStyle('admin::default/ionicons-2.0.1/css/ionicons.min.css');
		AssetManager::addStyle('admin::default/css/AdminLTE.min.css');
		
		AssetManager::addStyle('admin::default/css/skins/skin-'.\Config::get('admintheme.skin').'.min.css');


		AssetManager::addScript(route('admin.lang'));
		AssetManager::addScript('admin::default/plugins/jQuery/jQuery-2.1.4.min.js');
		AssetManager::addScript('admin::default/bootstrap/js/bootstrap.min.js');
		if( \Config::get('admintheme.fixed_layout') ) {
			AssetManager::addScript('admin::default/plugins/slimScroll/jquery.slimscroll.min.js');			
		}
		AssetManager::addScript('admin::default/js/app.min.js');
		AssetManager::addScript('admin::default/js/admin.js');

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