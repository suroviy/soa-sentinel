<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\Repository\BaseRepository;

class Select extends NamedFormItem
{

	protected $view 		= 'select';
	protected $model;
	protected $with;
	protected $display 		= 'title';
	protected $options 		= [];
	protected $nullable 	= false;
	protected $multi 		= false;
	protected $plugin 		= null;
	protected $seperator 	= '-';
	protected $scopes 		= [];
	protected $optionValue 	= null;
	protected $sort 		= true;
	protected $relation     = null;

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

	public function optionValue($optionValue = null)
	{
		if (is_null($optionValue))
		{
			return $this->optionValue;
		}
		$this->optionValue = $optionValue;
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

	public function options($options = null)
	{
		if (is_null($options))
		{
			if ( ! is_null($this->model()) && ! is_null($this->display()))
			{
				$this->loadOptions();
			}
			$options = $this->options;

			if( $this->sort() ) {
				asort($options);
			}

			return $options;
		}
		$this->options = $options;
		return $this;
	}

	public function disableSort()
	{
		$this->sort = false;
		return $this;
	}

	protected function sort() {
		return $this->sort;
	}

	public function relation($relation = null)
    {
        if (is_null($relation))
        {
            return $this->relation;
        }

        $this->relation = $relation;
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
					
					$value = $dataset[$display[0]];
					//$value = $dataset->$display[0];
				}

				$optionValue = $this->optionValue();

				$options[(is_null($optionValue)) ? $dataset->$key : $dataset->$optionValue] = $value;
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

	public function enum($values)
	{
		return $this->options(array_combine($values, $values));
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

    public function save()
    {
        if (! $this->canSaveRelation())
        {
            parent::save();
            return;
        }

        $relationClass = get_class($this->getToManyRelation());
        
        if ($this->instance()->id) {
            switch ($relationClass) {
                case 'Illuminate\Database\Eloquent\Relations\BelongsToMany':
                case 'Illuminate\Database\Eloquent\Relations\MorphToMany':
                    $this->getToManyRelation()->detach();
                    break;

                case 'Illuminate\Database\Eloquent\Relations\HasMany':
                case 'Illuminate\Database\Eloquent\Relations\MorphMany':
                    $this->detachHasMany();
                    break;
            }
        }
    }

    public function saved()
    {
        if (! $this->canSaveRelation())
        {
            parent::saved();
            return;
        }

        $objects = $this->getRelatedObjects();
        $relationClass = get_class($this->getToManyRelation());

        switch ($relationClass) {
            case 'Illuminate\Database\Eloquent\Relations\BelongsToMany':
            case 'Illuminate\Database\Eloquent\Relations\MorphToMany':
                $this->getToManyRelation()->attach($objects->pluck('id')->toArray());
                break;

            case 'Illuminate\Database\Eloquent\Relations\HasMany':
            case 'Illuminate\Database\Eloquent\Relations\MorphMany':
                $this->getToManyRelation()->saveMany($objects);
                break;
        }
    }

    private function canSaveRelation()
    {
        return $this->multi() && $this->relation() && $this->model();
    }

    private function getRelatedObjects()
    {
        $relatedModel = $this->model();

        return $relatedModel::whereIn('id', $this->value())->get();
    }

    private function getToManyRelation()
    {
        return call_user_func([
            $this->instance(),
            $this->relation()
        ]);
    }

    private function detachHasMany()
    {
        $attributes = [];
        $attributes[$this->getToManyRelation()->getPlainForeignKey()] = null;
        $this->getToManyRelation()->update($attributes);
    }
}