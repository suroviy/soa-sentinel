<?php namespace SleepingOwl\Admin\FormItems;

class Colorpicker extends NamedFormItem
{

	protected $view = 'colorpicker';
	protected $placement = null;
	protected $format = "hex";
	protected $align = "right";
	protected $colorSelectors = [];
	protected $horizontal = false;

	public function placement($placement = null)
	{
		if (is_null($placement))
		{
			return $this->placement;
		}
		$this->placement = $placement;
		return $this;
	}

	public function format($format) {
		if (is_null($format))
		{
			return $this->format;
		}
		$this->format = $format;
		return $this;
	}

	public function align($align)
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

	public function colorSelectors($colorSelectors)
	{
		if (is_null($colorSelectors))
		{
			return $this->$colorSelectors;
		}
		$this->$colorSelectors = $colorSelectors;
		return $this;	
	}


	public function attributes()
	{
		$attributes = [

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