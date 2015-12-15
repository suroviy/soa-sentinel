<?php namespace SleepingOwl\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

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
		'SleepingOwl\Admin\Providers\EventServiceProvider',

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


		// Publish migrations
        $migrations = realpath(__DIR__.'/Database/Migrations');

        $this->publishes([
            $migrations => $this->app->databasePath().'/migrations',
        ], 'migrations');

		$this->publishes([
			__DIR__ . '/../../../public/' => public_path('vendor/sleeping-owl/admin/'),
		], 'assets');


		//we need this, otherwise we have no access to existing session values
		//like the applocale which will be used to set the app language correctly
		app('SleepingOwl\Admin\Helpers\StartSession')->run();

		if (\Config::get('admin.language_switcher') && \Session::has('applocale') && array_key_exists(\Session::get('applocale'), \Config::get('admin.languages'))) {
            \App::setLocale(\Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            \App::setLocale(\Config::get('app.fallback_locale'));
        }

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
        	'admin.ckeditor.filebrowserBrowseUrl' 		=> call_user_func( config('admin.ckeditor.filebrowserBrowseUrl.type', 'url'), config('admin.ckeditor.filebrowserBrowseUrl.path', 'elfinder/ckeditor') ),
        	'admin.ckeditor.filebrowserImageBrowseUrl' 	=> call_user_func( config('admin.ckeditor.filebrowserImageBrowseUrl.type', 'url'), config('admin.ckeditor.filebrowserImageBrowseUrl.path', 'elfinder/ckeditor') ),
        	'admin.elfinderPopupUrl' 	=> call_user_func( config('admin.elfinderPopupUrl.type', 'url'), config('elfinderPopupUrl.path', 'elfinder/popup') ),
    	]);

		//fix for #56 - if the default config is in use - we will set the middleware to null
		//otherwise we will use the defined middleware
    	if( config("elfinder.route.middleware", "replace-this-with-your-middleware") == "replace-this-with-your-middleware" ) {
    		config([
    			"elfinder.route.middleware" => null
    		]);
    	}
	}

}