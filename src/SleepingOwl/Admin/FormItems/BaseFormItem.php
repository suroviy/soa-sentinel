<?php namespace SleepingOwl\Admin\FormItems;

use AdminTemplate;
use Illuminate\Contracts\Support\Renderable;
use SleepingOwl\Admin\Helpers\ExceptionHandler;
use SleepingOwl\Admin\Interfaces\FormItemInterface;

abstract class BaseFormItem implements Renderable, FormItemInterface
{

	protected $view;
	protected $instance;
	protected $label_size;
	protected $field_size;
	protected $help_text;
	protected $validationRules = [];
	protected $custom = false;

	public function initialize()
	{
	}

	public function setInstance($instance)
	{
		return $this->instance($instance);
	}

	public function setLabelSize($label_size)
	{
		return $this->label_size($label_size);
	}

	public function setFieldSize($field_size)
	{
		return $this->field_size($field_size);
	}


	public function instance($instance = null)
	{
		if (is_null($instance))
		{
			return $this->instance;
		}
		$this->instance = $instance;
		return $this;
	}

	public function label_size($label_size = null)
	{
		if (is_null($label_size))
		{
			return $this->label_size;
		}
		$this->label_size = $label_size;
		return $this;
	}

	public function field_size($field_size = null)
	{
		if (is_null($field_size))
		{
			return $this->field_size;
		}
		$this->field_size = $field_size;
		return $this;
	}

	public function help_text($help_text = null)
	{
		if (is_null($help_text))
		{
			return $this->help_text;
		}
		$this->help_text = $help_text;
		return $this;
	}

	public function custom($custom = null)
	{
		if (is_null($custom))
		{
			return $this->custom;
		}
		$this->custom = $custom;
		return $this;
	}

	public function validationRules($validationRules = null)
	{
		if (is_null($validationRules))
		{
			return $this->validationRules;
		}
		if (is_string($validationRules))
		{
			$validationRules = explode('|', $validationRules);
		}
		$this->validationRules = $validationRules;
		return $this;
	}

	public function getValidationRules()
	{
		return $this->validationRules();
	}

	public function validationRule($rule)
	{
		$this->validationRules[] = $rule;
		return $this;
	}

	public function save()
	{
	}

	public function saved()
	{
		
	}

	public function getParams()
	{
		return [
			'instance' 		=> $this->instance(),
			'label_size'	=> $this->label_size(),
			'field_size'	=> $this->field_size(),
			'help_text'		=> $this->help_text()
		];
	}

	public function render()
	{
		$params = $this->getParams();
		return view(AdminTemplate::view('formitem.' . $this->view), $params)->render();
	}

	function __toString()
	{
		try
		{
			return (string)$this->render();
		} catch (\Exception $e)
		{
			ExceptionHandler::handle($e);
		}
	}

}