<?php namespace SleepingOwl\Admin\FormItems;

use Illuminate\Support\Collection;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Repository\BaseRepository;

class Colorpicker extends NamedFormItem
{

	protected $view 			= 'colorpicker';
	protected $placement		= null;
	protected $format 			= "hex";
	protected $align 			= "right";
	protected $colorSelectors	= [];
	protected $horizontal 		= false;

	public function initialize()
	{
		parent::initialize();

		AssetManager::addStyle('admin::default/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');
		AssetManager::addScript('admin::default/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');
		AssetManager::addScript('admin::default/scripts/bootstrap-colorpicker/init.js');
	}

	public function placement($placement = null)
	{
		if (is_null($placement))
		{
			return $this->placement;
		}
		$this->placement = $placement;
		return $this;
	}

	public function format($format=null) {
		
		if (is_null($format))
		{
			return $this->format;
		}
		$this->format = $format;
		return $this;
	}

	public function align($align=null)
	{
		if (is_null($align))
		{
			return $this->align;
		}
		$this->align = $align;
		return $this;	
	}

	public function horizontal() {
		$this->horizontal = true;
		return $this;
	}

	public function colorSelectors($colorSelectors=null)
	{
		if (is_null($colorSelectors))
		{
			return $this->colorSelectors;
		}
		$this->colorSelectors = array_merge($colorSelectors, $this->colorSelectors);
		return $this;	
	}


	public function attributes()
	{
		$attributes = [
			'color'				=> $this->value(),
			'format'			=> $this->format(),
			'horizontal'		=> $this->horizontal,
			'align'				=> $this->align(),
			'colorSelectors'	=> $this->colorSelectors()
		];
		
		return $attributes;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'placement' => $this->placement(),
			'attributes'     => $this->attributes(),
		];
	}


}