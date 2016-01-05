<?php namespace SleepingOwl\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Session;

class AdminServiceProvider extends ServiceProvider
{

	/**
	 * Define Service Providers from our dependencies
	 */ 
	protected $parent_providers = [
		\Cartalyst\Sentinel\Laravel\SentinelServiceProvider::class,
		\Barryvdh\Elfinder\ElfinderServiceProvider::class,
		\Proengsoft\JsValidation\JsValidationServiceProvider::class,
		\Laracasts\Flash\FlashServiceProvider::class,
		\Grimthorr\LaravelUserSettings\ServiceProvider::class
	];

	/**
	 * Providers to register
	 */
	protected $providers = [
		\SleepingOwl\Admin\Providers\DisplayServiceProvider::class,
		\SleepingOwl\Admin\Providers\ColumnServiceProvider::class,
		\SleepingOwl\Admin\Providers\ColumnFilterServiceProvider::class,
		\SleepingOwl\Admin\Providers\FormServiceProvider::class,
		\SleepingOwl\Admin\Providers\FormItemServiceProvider::class,
		\SleepingOwl\Admin\Providers\FilterServiceProvider::class,
		\SleepingOwl\Admin\Providers\BootstrapServiceProvider::class,
		\SleepingOwl\Admin\Providers\RouteServiceProvider::class,
		\SleepingOwl\Admin\Providers\EventServiceProvider::class,
	];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [
		'Activation'    => \Cartalyst\Sentinel\Laravel\Facades\Activation::class,
        'Reminder'      => \Cartalyst\Sentinel\Laravel\Facades\Reminder::class,
        'Sentinel'      => \Cartalyst\Sentinel\Laravel\Facades\Sentinel::class,

        'Admin'         => \SleepingOwl\Admin\Admin::class,
        'Column'        => \SleepingOwl\Admin\Columns\Column::class,
        'ColumnFilter'  => \SleepingOwl\Admin\ColumnFilters\ColumnFilter::class,
        'Filter'        => \SleepingOwl\Admin\Filter\Filter::class,
        'AdminDisplay'  => \SleepingOwl\Admin\Display\AdminDisplay::class,
        'AdminForm'     => \SleepingOwl\Admin\Form\AdminForm::class,
        'AdminTemplate' => \SleepingOwl\Admin\Templates\Facade\AdminTemplate::class,
        'FormItem'      => \SleepingOwl\Admin\FormItems\FormItem::class,

        'JsValidator'   => \Proengsoft\JsValidation\Facades\JsValidatorFacade::class,
        'Flash'         => \Laracasts\Flash\Flash::class,
        'SoaUserSetting' 	=> \Grimthorr\LaravelUserSettings\Facade::class,
	];

	/**
	 * Commands to register
	 */
	protected $commands = [
		'InstallCommand',
		'ModelCommand'
	];

	/**
	 * Register Function
	 */
	public function register()
	{
		$this->registerParentProviders();
		$this->registerAliases();
		$this->updateFilebrowserConfig();
		$this->registerCommands();
	}

	/**
	 * Boot Function
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

		if( \Config::get('admin.language_switcher') ) 
		{
			if ( \Session::has('applocale') && array_key_exists(\Session::get('applocale'), \Config::get('admin.languages'))) {
	            \App::setLocale(\Session::get('applocale'));
	        } else {
	            \App::setLocale(\Config::get('app.fallback_locale'));
	        }
    	} else {
    		\App::setLocale(\Config::get('app.locale'));
    	}


		$this->registerTemplate();
		$this->registerProviders();
		$this->registerAliases();
		$this->initializeTemplate();

		Admin::instance();

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
	 * Register Dependency Providers
	 */
	protected function registerParentProviders()
	{
		foreach ($this->parent_providers as $parentProviderClass)
		{
			$this->app->register($parentProviderClass);
		}
	}

	/**
     * Register the aliases from this module.
     */
    protected function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->aliases as $aliasName => $aliasClass) {
            $loader->alias($aliasName, $aliasClass);
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