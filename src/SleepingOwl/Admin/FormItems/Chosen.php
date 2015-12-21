<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Chosen extends Select
{
    protected $plugin = 'chosen';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/plugins/chosen/bootstrap-chosen.css');
		AssetManager::addScript('admin::default/plugins/chosen/chosen.jquery.min.js');
		AssetManager::addScript('admin::default/scripts/select/init.js');
	}

}