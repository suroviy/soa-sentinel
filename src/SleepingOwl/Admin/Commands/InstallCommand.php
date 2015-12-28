<?php namespace SleepingOwl\Admin\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use SleepingOwl\Admin\Model\Permission as PermissionModel;


class InstallCommand extends Command
{

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'admin:install';
	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Install the admin package';

	protected $stubs 		= [
		'menu',
		'bootstrap',
		'routes',
		'User',
		'Role',
		'Permission'
	];

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{
		$title = $this->option('title');
		$path = $this->option('path');

		$this->call('vendor:publish', ['--provider' => 'SleepingOwl\Admin\AdminServiceProvider']);
		$this->call('vendor:publish', ['--provider' => 'Cartalyst\Sentinel\Laravel\SentinelServiceProvider']);
		$this->call('vendor:publish', ['--provider' => 'Proengsoft\JsValidation\JsValidationServiceProvider']);
		$this->call('elfinder:publish');
		$this->call('vendor:publish', ['--provider' => 'Barryvdh\Elfinder\ElfinderServiceProvider']);
		$this->removeLaravelAuth();
		$this->publishDB();
		$this->publishConfig($title);

		$this->createBootstrapDirectory();
		$this->createFilesFromStub();
		
		$this->createPublicDefaultStructure($path);
	}

	/**
	 * Migrate database and default seed
	 */
	protected function publishDB()
	{

		$this->call('migrate');

		$this->call('db:seed', [
			'--class' => 'SleepingOwl\\Admin\\Database\\Seeders\\SentinelRoleSeeder'
		]);

		$this->call('db:seed', [
			'--class' => 'SleepingOwl\\Admin\\Database\\Seeders\\SentinelUserSeeder'
		]);

		$this->call('db:seed', [
			'--class' => 'SleepingOwl\\Admin\\Database\\Seeders\\SentinelPermissionSeeder'
		]);
	}

	/**
	 * Create bootstrap directory
	 */
	protected function createBootstrapDirectory()
	{
		$directory = config('admin.bootstrapDirectory');

		if ( ! is_dir($directory))
		{
			$this->laravel['files']->makeDirectory($directory, 0755, true, true);
			$this->line('<info>Admin bootstrap directory was created:</info> ' . str_replace(base_path(), '', $directory));
		}
	}

	protected function createFilesFromStub() {


		foreach ($this->stubs as $stub) {
			$file = config('admin.bootstrapDirectory') . '/'.$stub.'.php';
			if ( ! file_exists($file))
			{
				$contents = $this->laravel['files']->get(__DIR__ . '/stubs/'.$stub.'.stub');
				$this->laravel['files']->put($file, $contents);
				$this->line('<info>'.$stub.' file was created:</info> ' . str_replace(base_path(), '', $file));
			}
		}
	}


	/**
	 * Create public default structure
	 */
	protected function createPublicDefaultStructure($path = null)
	{
		if (is_null($path)) {
			$path = config('admin.filemanagerDirectory');
		} else {
			$file = config_path('admin.php');
			$contents = $this->laravel['files']->get($file);
			$search = "'filemanagerDirectory' =>  'files/'";
			$replace = "'filemanagerDirectory' =>  '" . $path . "/'";
			$contents = str_replace($search, $replace, $contents);
			$this->laravel['files']->put($file, $contents);
		}

		$uploadsDirectory = public_path($path);
		if ( ! is_dir($uploadsDirectory))
		{
			$this->laravel['files']->makeDirectory($uploadsDirectory, 0755, true, true);
		}


	}

	/**
	 * Publish package config
	 * @param string|null $title
	 */
	protected function publishConfig($title = null)
	{
		$file = config_path('admin.php');
		if ( ! is_null($title))
		{
			$contents = $this->laravel['files']->get($file);
			$contents = str_replace('Sleeping Owl administrator', $title, $contents);
			$this->laravel['files']->put($file, $contents);
		}
	}

	protected function removeLaravelAuth() {
		$files = new Filesystem;

        $files->deleteDirectory(app_path('Http/Controllers/Auth'));

        $files->delete(base_path('database/migrations/2014_10_12_000000_create_users_table.php'));
        $files->delete(base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php'));

        $this->info('Laravel Auth removed! Enjoy your fresh start.');
	}

	/**
	 * Get the console command options.
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			[
				'title',
				null,
				InputOption::VALUE_REQUIRED,
				'Title for admin module.'
			],
			[
				'path',
				null,
				InputOption::VALUE_REQUIRED,
				'Path for filemanager directory relative to public directory. Please set no / at the end!'
			],
		];
	}

}