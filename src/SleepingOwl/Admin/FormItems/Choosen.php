<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Choosen extends Select
{
    protected $plugin = 'choosen';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/css/formitems/select/chosen.css');
		AssetManager::addScript('admin::default/js/formitems/select/chosen.jquery.min.js');
		AssetManager::addScript('admin::default/js/formitems/select/init.js');
	}

}