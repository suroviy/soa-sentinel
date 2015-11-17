<?php namespace SleepingOwl\Admin\FormItems;

use Input;
use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class SwitchCheckbox extends Checkbox
{
	protected $view 			= "switchcheckbox";
	protected $size				= "normal";
	protected $animate			= true;
	protected $indeterminate	= false;
	protected $inverse			= false;
	protected $onColor			= "primary";
	protected $offColor			= "default";
	protected $onText			= "ON";
	protected $offText			= "OFF";
	protected $labelText		= "&nbsp;";
	protected $handleWidth		= "auto";
	protected $labelWidth		= "auto";

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css');
		AssetManager::addStyle('admin::default/css/form-items/bootstrap-switch.css');
		AssetManager::addScript('admin::default/plugins/bootstrap-switch/js/bootstrap-switch.min.js');
		AssetManager::addScript('admin::default/scripts/bootstrap-switch/init.js');
	}

	public function size($size=null)
	{
		if (is_null($size))
		{
			return $this->size;
		}
		$this->size = $size;
		return $this;
	}

	public function animate($animate=null)
	{
		if (is_null($animate))
		{
			return $this->animate;
		}
		$this->animate = $animate;
		return $this;
	}

	public function indeterminate($indeterminate=null)
	{
		if (is_null($indeterminate))
		{
			return $this->indeterminate;
		}
		$this->indeterminate = $indeterminate;
		return $this;
	}

	public function inverse($inverse=null)
	{
		if (is_null($inverse))
		{
			return $this->inverse;
		}
		$this->inverse = $inverse;
		return $this;
	}

	public function onColor($onColor=null)
	{
		if (is_null($onColor))
		{
			return $this->onColor;
		}
		$this->onColor = $onColor;
		return $this;
	}

	public function offColor($offColor=null)
	{
		if (is_null($offColor))
		{
			return $this->offColor;
		}
		$this->offColor = $offColor;
		return $this;
	}

	public function onText($onText=null)
	{
		if (is_null($onText))
		{
			return $this->onText;
		}
		$this->onText = $onText;
		return $this;
	}

	public function offText($offText=null)
	{
		if (is_null($offText))
		{
			return $this->offText;
		}
		$this->offText = $offText;
		return $this;
	}

	public function labelText($labelText=null)
	{
		if (is_null($labelText))
		{
			return $this->labelText;
		}
		$this->labelText = $labelText;
		return $this;
	}

	public function handleWidth($handleWidth=null)
	{
		if (is_null($handleWidth))
		{
			return $this->handleWidth;
		}
		$this->handleWidth = $handleWidth;
		return $this;
	}

	public function labelWidth($labelWidth=null)
	{
		if (is_null($labelWidth))
		{
			return $this->labelWidth;
		}
		$this->labelWidth = $labelWidth;
		return $this;
	}

	public function attributes()
	{
		$attributes = [
			'size'				=> $this->size(),
			'animate'			=> $this->animate(),
			'indeterminate'		=> $this->indeterminate(),
			'inverse'			=> $this->inverse(),
			'onColor'			=> $this->onColor(),
			'offColor'			=> $this->offColor(),
			'onText'			=> $this->onText(),
			'offText'			=> $this->offText(),
			'labelText'			=> $this->labelText(),
			'handleWidth'		=> $this->handleWidth(),
			'labelWidth'		=> $this->labelWidth(),
		];
		
		return $attributes;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'attributes'     => $this->attributes(),
		];
	}

}