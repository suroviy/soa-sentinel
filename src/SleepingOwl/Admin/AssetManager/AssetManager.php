<?php namespace SleepingOwl\Admin\AssetManager;

class AssetManager
{

	/**
	 * Registered styles
	 * @var string[]
	 */
	protected static $styles = [];
	/**
	 * Registered scripts
	 * @var string[]
	 */
	protected static $scripts = [];

	/**
	 * Registered custom styles
	 * @var string[]
	 */
	protected static $customstyles = [];
	/**
	 * Registered  custom scripts
	 * @var string[]
	 */
	protected static $customscripts = [];

	/**
	 * Return all registered styles
	 * @return string[]
	 */
	public static function styles()
	{
		$styles = array_merge(static::$styles, static::$customstyles);
		return static::assets($styles);
	}

	/**
	 * Register style
	 * @param $style
	 */
	public static function addStyle($style)
	{
		static::$styles[] = $style;
	}

	/**
	 * Register style
	 * @param $style
	 */
	public static function customStyle($style)
	{
		static::$customstyles[] = $style;
	}

	/**
	 * Get all registered scripts
	 * @return string[]
	 */
	public static function scripts()
	{
		$scripts = array_merge(static::$scripts, static::$customscripts);
		return static::assets($scripts);
	}

	/**
	 * Register script
	 * @param $script
	 */
	public static function addScript($script)
	{
		static::$scripts[] = $script;
	}

	/**
	 * Register script
	 * @param $script
	 */
	public static function customScript($script)
	{
		static::$customscripts[] = $script;
	}

	/**
	 * Get only unique values from $assets and generate admin package asset urls
	 * @param string[] $assets
	 * @return string[]
	 */
	protected static function assets($assets)
	{
		return array_map(function ($asset)
		{
			if (strpos($asset, 'admin::') !== false)
			{
				$asset = str_replace('admin::', '', $asset);
				return asset('vendor/sleeping-owl/admin/' . $asset);
			}
			return $asset;
		}, array_unique($assets));
	}

}