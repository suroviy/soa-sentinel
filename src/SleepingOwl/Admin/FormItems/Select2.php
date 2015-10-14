<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Select2 extends Select
{
    protected $plugin = 'bsselect2';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/plugins/select2/select2.min.css');
		AssetManager::addScript('admin::default/plugins/select2/select2.min.js');
		AssetManager::addScript('admin::default/scripts/select/init.js');
	}

}