<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;


class Typeahead extends NamedFormItem
{

	protected $view 		= 'typeahead';
	protected $model;
	protected $with;
	protected $display 		= 'name';
	protected $displayText 	= 'item.name';
	protected $fillAfter 	= [];
	protected $options 		= [];
	protected $scopes 		= [];
	protected $items 		= 'all';
	protected $minLength	= 1;
	protected $showHint		= false;
	protected $autoSelect	= false;

	public function initialize()
	{
		parent::initialize();

		AssetManager::addScript('admin::default/plugins/bootstrap-typeahead/js/bootstrap3-typeahead.min.js');
		AssetManager::addScript('admin::default/scripts/bootstrap-typeahead/init.js');
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

	public function scope($scope = null)
	{
		if (is_null($scope))
		{
			return $this->scopes;
		}
		$this->scopes[] = func_get_args();
		return $this;
	}

	public function with($with = null)
	{
		if (is_null($with))
		{
			return $this->with;
		}
		$this->with = $with;
		return $this;
	}

	public function display($display = null)
	{
		if (is_null($display))
		{
			return $this->display;
		}
		$this->display = $display;
		return $this;
	}

	public function displayText($displayText = null)
	{
		if (is_null($displayText))
		{
			return $this->displayText;
		}
		$this->displayText = $displayText;
		return $this;
	}

	public function fillAfter($fillAfter = null)
	{
		if (is_null($fillAfter))
		{
			return $this->fillAfter;
		}
		$this->fillAfter = $fillAfter;
		return $this;
	}

	public function items($items = null)
	{
		if (is_null($items))
		{
			return $this->items;
		}
		$this->items = $items;
		return $this;
	}

	public function autoSelect($autoSelect = null)
	{
		if (is_null($autoSelect))
		{
			return $this->autoSelect;
		}
		$this->autoSelect = $autoSelect;
		return $this;
	}

	public function showHint($showHint = null)
	{
		if (is_null($showHint))
		{
			return $this->showHint;
		}
		$this->showHint = $showHint;
		return $this;
	}

	public function minLength($minLength = null)
	{
		if (is_null($minLength))
		{
			return $this->minLength;
		}
		$this->minLength = $minLength;
		return $this;
	}

	public function options($options = null)
	{
		if (is_null($options))
		{
			if ( ! is_null($this->model()) && ! is_null($this->display()))
			{
				$this->loadOptions();
			}
			$options = $this->options;

			return $options;
		}
		$this->options = $options;
		return $this;
	}

	protected function loadOptions()
	{
		$repository = new BaseRepository($this->model());
		$display = explode('|', $this->display());
		$key = $repository->model()->getKeyName();

		$model = $repository->query();
		if ( !is_null($this->with())) {
			$model = $model->with($this->with());
		}

		if ( count($this->scope())) {
			$this->modifyQuery($model);
		}

		$model = $model->get();

		$options = [];

		if ($model instanceof Collection)
		{
			$datasets = $model->all();
			foreach( $datasets as $dataset  ) {
				$itemCount = count($display);
				$count = 0;
				$tmpOptions=[];

				$tmpOptions[$key] = $dataset->$key;
		
				if ( $itemCount > 1 ) {
					

					foreach( $display as $item ) {
						$count++;
						$valueTmp = $dataset->$item;

						if ( is_null ( $valueTmp  ) && !is_null($with = $this->with()) ) {
							$valueTmp = $dataset->$with->$item;
						}

						$tmpOptions[$item] = $valueTmp;
					}
				} else {
					$tmpOptions[$display[0]] = $dataset->$display[0];
				}

				$options[$count] = $tmpOptions;
			}
		}

		$this->options($options);
	}

	public function getParams()
	{
		return parent::getParams() + [
			'options'  		=> $this->options(),
			'fillAfter' 	=> $this->fillAfter(),
			'displayText'	=> $this->displayText(),
			'items'			=> $this->items(),
			'minLength'		=> $this->minLength(),
			'showHint'		=> $this->showHint(),
			'autoSelect'	=> $this->autoSelect()
		];
	}

	public function value()
	{
		$value = parent::value();
		if ($value instanceof Collection  && $value->count() > 0)
		{
			$value = $value->lists($value->first()->getKeyName());
		}
		if ($value instanceof Collection)
		{
			$value = $value->toArray();
		}
		return $value;
	}

	protected function modifyQuery($query)
	{
		foreach ($this->scope() as $scope)
		{
			if ( ! is_null($scope))
			{
				$method = array_shift($scope);
				call_user_func_array([
					$query,
					$method
				], $scope);
			}
		}
	}

}