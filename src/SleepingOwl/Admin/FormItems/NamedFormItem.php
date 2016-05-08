<?php namespace SleepingOwl\Admin\FormItems;

use Input;
use Illuminate\Http\Request;

abstract class NamedFormItem extends BaseFormItem
{

	protected $path;
	protected $name;
	protected $attribute;
	protected $label;
	protected $defaultValue;
	protected $readonly;
	protected $storable=true;
	protected $isRequired;
	protected $lang=false;

	function __construct($path, $label = null)
	{
		$this->label = $label;
		$parts = explode(".", $path);
		if (count($parts) > 1) {
			$this->path = $path;
			$this->name = $parts[0] . "[" . implode("][", array_slice($parts, 1)) . "]";
			$this->attribute = $path;//implode(".", array_slice(explode(".", $path), -1, 1));
		} else {
			$this->path = $path;
			$this->name = $path;
			$this->attribute = $path;
		}
	}

	public function path($path = null)
	{
		if (is_null($path))
		{
			if( $this->lang() ) {
				return $this->lang()."_".$this->path;
			} else {
				return $this->path;
			}
		}
		$this->path = $path;
		return $this;
	}

	public function attribute($attribute = null)
	{
		if (is_null($attribute))
		{
			// if( $this->lang() ) {
			// 	return $this->lang()."_".$this->attribute;
			// } else {
				return $this->attribute;
			//}
		}
		$this->attribute = $attribute;
		return $this;
	}

	public function name($name = null)
	{
		if (is_null($name))
		{
			return $this->name;
		}
		$this->name = $name;
		return $this;
	}

	public function label($label = null)
	{
		if (is_null($label))
		{
			return $this->label;
		}
		$this->label = $label;
		return $this;
	}

	public function lang($lang = null)
	{
		if (is_null($lang))
		{
			return $this->lang;
		}
		$this->lang = $lang;
		return $this;
	}

	public function storable($storable = null)
	{
		if (is_null($storable))
		{
			return $this->storable;
		}
		$this->storable = $storable;
		return $this;
	}

	public function isRequired($isRequired = null)
	{
		if (is_null($isRequired))
		{
			return $this->isRequired;
		}
		$this->isRequired = $isRequired;
		return $this;
	}

	public function getParams()
	{

		return parent::getParams() + [
			'name'      => $this->name(),
			'label'     => $this->label(),
			'readonly'  => $this->readonly(),
			'value'     => $this->value(),
			'required_field'	=> $this->isRequired(),
			'lang'		=> $this->lang()
		];
	}

	public function defaultValue($defaultValue = null)
	{
		if (is_null($defaultValue))
		{
			return $this->defaultValue;
		}
		$this->defaultValue = $defaultValue;
		return $this;
	}

	public function readonly($readonly = null)
	{
		if (is_null($readonly))
		{
			return $this->readonly;
		}

		$this->readonly = $readonly;

		return $this;
	}

	public function value()
	{
		$instance = $this->instance();

		if ( ! is_null($value = old($this->path())))
		{
			return $value;
		}
		$input = \Request::all();
		if (($value = array_get($input, $this->path())) !== null)
		{
			return $value;
		}

		$attribute = $this->attribute();
		
		/*Alex*/
		$atr = explode('.',$attribute);
		if (isset($atr[1])){
			$array = $instance->$atr[0];
			if(isset($array[$atr[1]])) {
				return $array[$atr[1]];
			}
		}

        	if ( !is_null($instance) && $this->lang() && !is_null($value = $instance->translate($this->lang()))) {
            		return $value->$attribute;
        	}

        	if (!is_null($instance) && !$this->lang() && !is_null($value = $instance->getAttribute($attribute))) {
            		return $value;
        	}

		return $this->defaultValue();
	}

	public function save()
	{
		$attribute = $this->attribute();

		if ( $this->storable() ) {
			if (\Request::input($this->path()) === null) {
				$value = null;
			} else {
				$value = $this->value();
			}

			if(!$this->lang()) {

				/*Alex*/
				$atr = explode('.',$attribute);
				if (isset($atr[1])){
					$array = $this->instance()->$atr[0];

					if (!is_array($array)){
						$array = [];
					}
					$array[$atr[1]] = $value;

					$this->instance()->$atr[0] = $array;
				}else{
					$this->instance()->$attribute = $value;
				}
				
			} else {

				if( $this->instance()->translate() ) {
					$this->instance()->translateOrNew($this->lang())->$attribute = $value;
				} else {

					/*Alex*/
					$atr = explode('.',$attribute);
					if (isset($atr[1])){
						$array = $this->instance()->$atr[0];

						if (!is_array($array)){
							$array = [];
						}
						$array[$atr[1]] = $value;

						$this->instance()->$atr[0] = $array;
					}else{
						$this->instance()->$attribute = $value;
					}
					
				}
			}
		}
	}

	public function required()
	{
		$this->isRequired(true);
		return $this->validationRule('required');
	}

	public function unique()
	{
		return $this->validationRule('_unique');
	}

	public function getValidationRules()
	{
		$rules = parent::getValidationRules();
		array_walk($rules, function (&$item)
		{
			if ($item == '_unique')
			{
				$table = $this->instance()->getTable();
				$item = 'unique:' . $table . ',' . $this->attribute();
				if ($this->instance()->exists())
				{
					$item .= ',' . $this->instance()->getKey();
				}
			}
		});
		return [
			$this->path() => $rules
		];
	}

}
