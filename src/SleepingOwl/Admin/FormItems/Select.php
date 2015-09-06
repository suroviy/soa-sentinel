<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\Repository\BaseRepository;

class Select extends NamedFormItem
{

	protected $view = 'select';
	protected $model;
	protected $display = 'title';
	protected $options = [];
	protected $nullable = false;
	protected $multi = false;
	protected $plugin = null;
	protected $seperator = '-';

	public function model($model = null)
	{
		if (is_null($model))
		{
			return $this->model;
		}
		$this->model = $model;
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
			return ' ' . trim($this->seperator) . ' ';
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

		$key = $repository->model()->getKeyName();
		$model = $repository->query()->get(array_add($display, 'id', 'id'));
		$options = [];
		$value = "";

		if ($model instanceof Collection)
		{
			$datasets = $model->all();
			foreach( $datasets as $dataset  ) {
				$itemCount = count($display);
				if ( $itemCount > 1 ) {
					$count = 0;
					foreach( $display as $item ) {
						$count++;
						$value .= $dataset->$item;

						if ($count <= $itemCount ) {
							if ( $dataset->$item ) {
								$value .= ($dataset->$item == $key) ? '#' : $this->seperator();
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

}