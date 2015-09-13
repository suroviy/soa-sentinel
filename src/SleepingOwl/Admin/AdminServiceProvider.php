<?php namespace SleepingOwl\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

	/**
	 * Providers to register
	 */
	protected $providers = [
		'SleepingOwl\Admin\Providers\DisplayServiceProvider',
		'SleepingOwl\Admin\Providers\ColumnServiceProvider',
		'SleepingOwl\Admin\Providers\ColumnFilterServiceProvider',
		'SleepingOwl\Admin\Providers\FormServiceProvider',
		'SleepingOwl\Admin\Providers\FormItemServiceProvider',
		'SleepingOwl\Admin\Providers\FilterServiceProvider',
		'SleepingOwl\Admin\Providers\BootstrapServiceProvider',
		'SleepingOwl\Admin\Providers\RouteServiceProvider',
	];

	/**
	 * Commands to register
	 */
	protected $commands = [
		'InstallCommand',
		'ModelCommand'
	];

	/**
	 *
	 */
	public function register()
	{
		$this->updateFilebrowserConfig();
		$this->registerCommands();
	}

	/**
	 *
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../../views', 'admin-lte');
		$this->loadTranslationsFrom(__DIR__ . '/../../lang', 'admin');
		$this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'admin');
		$this->mergeConfigFrom(__DIR__ . '/../../config/theme.php', 'admintheme');

		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('admin.php'),
			__DIR__ . '/../../config/theme.php' => config_path('admintheme.php'),
		], 'config');


		$this->publishes([
			__DIR__ . '/../../../public/' => public_path('packages/sleeping-owl/admin/'),
		], 'assets');


		//app('SleepingOwl\Admin\Helpers\StartSession')->run();

		Admin::instance();
		$this->registerTemplate();
		$this->registerProviders();
		$this->initializeTemplate();
	}

	/**
	 * @return array
	 */
	public function provides()
	{
		return ['admin'];
	}

	/**
	 * Bind current template
	 */
	protected function registerTemplate()
	{
		app()->bind('adminTemplate', function ()
		{
			return Admin::instance()->template();
		});
	}

	/**
	 * Initialize template
	 */
	protected function initializeTemplate()
	{
		app('adminTemplate');
	}

	/**
	 * Register providers
	 */
	protected function registerProviders()
	{
		foreach ($this->providers as $providerClass)
		{
			$provider = app($providerClass, [app()]);
			$provider->register();
		}
	}

	/**
	 * Register commands
	 */
	protected function registerCommands()
	{
		foreach ($this->commands as $command)
		{
			$this->commands('SleepingOwl\Admin\Commands\\' . $command);
		}
	}

	/**
	 * Config Replacement for the CK Editor,
	 * because to use url() inside the config file generates an Error in the CLI
	 */ 
	protected function updateFilebrowserConfig() {
		config([
        	'admin.ckeditor.filebrowserBrowseUrl' 		=> call_user_func( config('admin.ckeditor.filebrowserBrowseUrl.type'), config('admin.ckeditor.filebrowserBrowseUrl.path') ),
        	'admin.ckeditor.filebrowserImageBrowseUrl' 	=> call_user_func( config('admin.ckeditor.filebrowserImageBrowseUrl.type'), config('admin.ckeditor.filebrowserImageBrowseUrl.path') ),
    	]);
	}

}