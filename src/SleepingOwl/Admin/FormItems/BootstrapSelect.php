<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class BootstrapSelect extends Select
{
    protected $plugin = 'bsselect';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/plugins/bootstrap-select/css/bootstrap-select.min.css');
		AssetManager::addScript('admin::default/plugins/bootstrap-select/js/bootstrap-select.min.js');
		AssetManager::addScript('admin::default/scripts/select/init.js');
	}

}