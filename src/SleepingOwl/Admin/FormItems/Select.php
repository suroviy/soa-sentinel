<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\Repository\BaseRepository;

class Select extends NamedFormItem
{

	protected $view = 'select';
	protected $model;
	protected $with;
	protected $display = 'title';
	protected $options = [];
	protected $nullable = false;
	protected $multi = false;
	protected $plugin = null;
	protected $seperator = '-';
	protected $scopes = [];

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

	public function seperator($seperator = null)
	{
		if (is_null($seperator))
		{
			return $this->seperator;
		}
		$this->seperator = $seperator;
		return $this;
	}

	public function options($options = null, $sort=true)
	{
		if (is_null($options))
		{
			if ( ! is_null($this->model()) && ! is_null($this->display()))
			{
				$this->loadOptions();
			}
			$options = $this->options;

			if($sort) {
				asort($options);
			}

			return $options;
		}
		$this->options = $options;
		return $this;
	}

	protected function loadOptions()
	{
		$repository = new BaseRepository($this->model());
		$display = explode('|', $this->display());
		$seperator = explode('|', $this->seperator());

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
		$value = "";

		if ($model instanceof Collection)
		{
			$datasets = $model->all();
			foreach( $datasets as $dataset  ) {
				$itemCount = count($display);
				if ( $itemCount > 1 ) {
					$count = 0;
					$value = null;
					foreach( $display as $item ) {
						$count++;
					    $valueTmp = $dataset->$item;

						if ( is_null ( $valueTmp  ) && !is_null($with = $this->with()) ) {
							$valueTmp = $dataset->$with->$item;
						}

						$value .= $valueTmp;
						if ($count < $itemCount ) {
							if ( $valueTmp ) {
								if (array_has($seperator, $count - 1)) {
									$sep = $seperator[$count - 1];
								} else {
									$sep = '-';
								}

								$value .= ($dataset->$item == $key) ? '#' : ' ' . $sep . ' ';
							}
						}
					}
				} else {
					$value = $dataset->$display[0];
				}

				$options[$dataset->$key] = $value;
			}
		}

		$this->options($options);
	}

	public function getParams()
	{
		return parent::getParams() + [
			'options'  	=> $this->options(),
			'nullable' 	=> $this->isNullable(),
			'multi' 	=> $this->multi(),
			'plugin' 	=> $this->plugin
		];
	}

	public function enum($values, $sort=true)
	{
		return $this->options(array_combine($values, $values), $sort);
	}

	public function nullable($nullable = true)
	{
		$this->nullable = $nullable;
		return $this;
	}

	public function isNullable()
	{
		return $this->nullable;
	}

	public function multi($multi = null)
	{
		if (is_null($multi))
		{
			return $this->multi;
		}
		$this->multi = $multi;
		return $this;
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