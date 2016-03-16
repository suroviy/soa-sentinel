<?php namespace SleepingOwl\Admin\FormItems;

use Input;
use Response;
use Route;
use Illuminate\Http\Request;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Interfaces\WithRoutesInterface;
use Validator;

class Image extends NamedFormItem implements WithRoutesInterface
{

	protected $view = 'image';
	protected $upload_path;
	protected static $route = 'image';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addScript('admin::default/scripts/image/init.js');
		AssetManager::addScript('admin::default/plugins/flow/flow.min.js');
	}

	public function upload_path($upload_path = null)
	{
		if (is_null($upload_path))
		{
			return $this->upload_path;
		}

		$this->upload_path = $upload_path;
		return $this;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'path'  => $this->upload_path()
		];
	}

	public static function registerRoutes()
	{
		Route::post('upload/' . static::$route, [
			'as' => 'admin.upload.' . static::$route,
			function ()
			{
				$validator = Validator::make(\Request::all(), static::uploadValidationRules());
				if ($validator->fails())
				{
					return Response::make($validator->errors()->get('file'), 400);
				}
				$file = \Request::file('file');
				$upload_path = config('admin.filemanagerDirectory') . \Request::input('path');

				$orginalFilename = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
				$filename = $orginalFilename . '.' . $file->getClientOriginalExtension();

				$fullpath = public_path($upload_path);

				if ( !\File::isDirectory($fullpath) ) {
					\File::makeDirectory($fullpath , 0755, true);
				}

				if ( $oldFilename = \Request::input('filename') ) {
					\File::delete($oldFilename);
				}

				if ( \File::exists($fullpath . '/' . $filename)) {
					$filename = str_slug($orginalFilename . '-' . time()). '.' . $file->getClientOriginalExtension();
				}

				$filepath = $upload_path . '/' . $filename;

				$file->move($fullpath, $filename );

				return [
					'url'   => asset($filepath),
					'value' => $filepath,
				];
			}
		]);

		Route::post('upload/delete/' . static::$route, [
			'as' => 'admin.upload.delete.' . static::$route,
			function ()
			{
				if ( $filename = \Request::input('filename') ) {
					\File::delete($filename);
					return "Success";
				}

				return null;
			}
		]);
	}

	protected static function uploadValidationRules()
	{
		return [
			'file' => 'image',
		];
	}

}