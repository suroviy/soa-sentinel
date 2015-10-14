<?php namespace SleepingOwl\Admin\Templates;

use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Interfaces\TemplateInterface;

class TemplateDefault implements TemplateInterface
{

	function __construct()
	{
		AssetManager::addStyle('admin::default/plugins/bootstrap/css/bootstrap.min.css');
		AssetManager::addStyle('admin::default/plugins/font-awesome/css/font-awesome.min.css');
		AssetManager::addStyle('admin::default/plugins/ionicons/css/ionicons.min.css');
		AssetManager::addStyle('admin::default/css/base/admin-lte.min.css');

		AssetManager::addStyle('admin::default/css/base/skins/skin-'.\Config::get('admintheme.skin').'.min.css');


		AssetManager::addScript(route('admin.lang'));
		AssetManager::addScript('admin::default/plugins/jquery/jquery-2.1.4.min.js');
		AssetManager::addScript('admin::default/plugins/bootstrap/js/bootstrap.min.js');
		if( \Config::get('admintheme.fixed_layout') ) {
			AssetManager::addScript('admin::default/plugins/jquery-slimscroll/jquery.slimscroll.min.js');
		}
		AssetManager::addScript('admin::default/scripts/base/app.min.js');
		AssetManager::addScript('admin::default/scripts/base/admin.js');

	}

	public function view($view)
	{
		$currentView = 'admin-lte::default.' . $view;
		if (\View::exists($currentView))
		{
			return $currentView;
		}
		abort(404);
	}

}