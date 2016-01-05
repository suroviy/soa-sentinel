<?php namespace SleepingOwl\Admin\Http\Controllers;

use AdminTemplate;
use App;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Input;
use Redirect;
use ReflectionClass;
use SleepingOwl\Admin\Form\FormDefault;
use SleepingOwl\Admin\Interfaces\FormInterface;
use SleepingOwl\Admin\Repository\BaseRepository;
use Illuminate\Http\Request;


class AdminController extends Controller
{

	public function getDisplay(Request $request, $model)
	{
		//added redirect to redirect back to the last model
		if( !is_null( $request->input('_action') ) ) {
			$model->display();
			return redirect()->route('admin.model', ['adminModel' => $model->alias()]);
		}
		return $this->render($model->title(), $model->display());
	}

	public function getCreate($model)
	{
		$create = $model->create();
		if (is_null($create))
		{
			abort(404);
		}
		return $this->render($model->title(), $create);
	}

	public function postStore(Request $request, $model)
	{

		$create = $model->create();

		if (is_null($create))
		{
			abort(404);
		}
		if ($create instanceof FormInterface)
		{
			if ($validator = $create->validate($model))
			{
				return Redirect::back()->withErrors($validator)->withInput()->with([
					'_redirectBack' => $request->input('_redirectBack'),
				]);
			}

			if ( !$create instanceof FormDefault || $create->storable() ) {
				$create->save($model);
			} elseif ( !$create->storable() && !is_null($create->event_handler())) {
				$reflect  = new ReflectionClass($create->event_handler());
				$instance = $reflect->newInstance($create, $request->all());
				\Event::fire($instance);
			} else {
				abort(500, 'Please define form storable as true or set the event handler for storage.');
			};
		}
		flash()->success(trans('admin::lang.save.create'));
		return Redirect::to($request->input('_redirectBack', $model->displayUrl()));
	}

	public function getEdit($model, $id)
	{
		$edit = $model->fullEdit($id);
		if (is_null($edit))
		{
			abort(404);
		}
		return $this->render($model->title(), $edit);
	}

	public function postUpdate(Request $request, $model, $id)
	{
		$edit = $model->fullEdit($id);
		if (is_null($edit))
		{
			abort(404);
		}
		if ($edit instanceof FormInterface)
		{
			if ($validator = $edit->validate($model))
			{
				return Redirect::back()->withErrors($validator)->withInput()->with([
					'_redirectBack' => $request->input('_redirectBack'),
				]);
			}

			if ( !$edit instanceof FormDefault || $edit->storable() ) {
				$edit->save($model);
			} elseif ( !$edit->storable() && !is_null($edit->event_handler())) {
				$reflect  = new ReflectionClass($edit->event_handler());
				$instance = $reflect->newInstance($edit, $request->all());
				\Event::fire($instance);
			} else {
				abort(500, 'Please define form storable as true or set the event handler for storage.');
			};
		}
		flash()->success(trans('admin::lang.save.edit'));
		return Redirect::to($request->input('_redirectBack', $model->displayUrl()));
	}

	public function postDestroy($model, $id)
	{
		$delete = $model->delete($id);
		if (is_null($delete))
		{
			abort(404);
		}
		$model->repository()->delete($id);
		flash()->success(trans('admin::lang.save.destroy'));
		return Redirect::back();
	}

	public function postRestore($model, $id)
	{
		$restore = $model->restore($id);
		if (is_null($restore))
		{
			abort(404);
		}
		$model->repository()->restore($id);
		flash()->success(trans('admin::lang.save.restore'));
		return Redirect::back();
	}

	public function render($title, $content)
	{
		if ($content instanceof Renderable)
		{
			$content = $content->render();
		}
		return view(AdminTemplate::view('_layout.inner'), [
			'title'   => $title,
			'content' => $content,
		]);
	}

	public function getLang()
	{
		$lang = trans('admin::lang');
		if ($lang == 'admin::lang')
		{
			$lang = trans('admin::lang', [], 'messages', 'en');
		}

		$data = array(
			'locale' => App::getLocale(),
			'token'  => csrf_token(),
			'prefix' => config('admin.prefix'),
			'lang'   => $lang,
			'ckeditor_cfg' => config('admin.ckeditor'),
			'elfinder_url' => config('admin.elfinderPopupUrl'),
		);

		$content = 'window.admin = '.json_encode($data) . ';';

		$response = new Response($content, 200, [
			'Content-Type' => 'text/javascript',
		]);

		return $this->cacheResponse($response);
	}

	public function switchLang($lang)
    {
        if (array_key_exists($lang, \Config::get('admin.languages'))) {
            \Session::set('applocale', $lang);
        }
        
        return Redirect::back();	    
    }

    public function getSettings() 
    {
    	$skins = [
    		'blue' 			=> 'Blue',
    		'blue-light' 	=> 'Blue Light',
			'black' 		=> 'Black',
			'black-light' 	=> 'Black Light',
			'purple' 		=> 'Purple',
			'purple-light' 	=> 'Purple Light',
			'green' 		=> 'Green',
			'green-light' 	=> 'Green Light',
			'red' 			=> 'Red',
			'red-light' 	=> 'Red Light',
			'yellow' 		=> 'Yellow',
			'yellow-light' 	=> 'Yellow Light',
    	];

    	$items	= [

    		
    		\FormItem::select('theme.skin', 'Theme Skin')
    			->options($skins)
    			->defaultValue( \SoaUserSetting::get('theme.skin', config('admintheme.skin') ) ),

    		\FormItem::checkbox('theme.fixed_layout', 'Fixed Layout')
    			->defaultValue( \SoaUserSetting::get('theme.fixed_layout', config('admintheme.fixed_layout') ) )
    			->help_text('You can\'t use fixed and boxed layouts together.'),

    		\FormItem::checkbox('theme.boxed_layout', 'Boxed Layout')
    			->defaultValue( \SoaUserSetting::get('theme.boxed_layout', config('admintheme.boxed_layout') ) )
    			->help_text('You can\'t use fixed and boxed layouts together.'),

    		\FormItem::checkbox('theme.sidebar_mini', 'Minimize Sidebar')
    			->defaultValue( \SoaUserSetting::get('theme.sidebar_mini', config('admintheme.sidebar_mini') ) ),

    		\FormItem::checkbox('theme.toggle_sidebar', 'Toggle Sidebar')
    			->defaultValue( \SoaUserSetting::get('theme.toggle_sidebar', config('admintheme.toggle_sidebar') ) )
    			->help_text('Toggle the left sidebar\'s state (open or collapse)'),

    		\FormItem::checkbox('theme.sidebar_on_hover', 'Sidebar on Hover')
    			->defaultValue( \SoaUserSetting::get('theme.sidebar_on_hover', config('admintheme.sidebar_on_hover') ) )
    			->help_text('Let the sidebar mini expand on hover'),
    	
    	];

    	return $this->render(
    					trans('admin::lang.settings'), 
    					view( AdminTemplate::view('pages.admin_settings'), compact('items') ) 
    				);
    }

    public function postSettings() 
    {
    	$fields = [
    		'theme.fixed_layout'		=> 'checkbox',
    		'theme.boxed_layout'		=> 'checkbox',
    		'theme.sidebar_mini'		=> 'checkbox',
    		'theme.toggle_sidebar'		=> 'checkbox',
    		'theme.sidebar_on_hover'	=> 'checkbox',

    	];

    	foreach ($fields as $key => $value) {
			if ( ! \Request::has($key))
			{
				\Request::merge([$key => false]);
			} else {
				\Request::merge([$key => true]);
			}
    	}

    	$settings = \Request::except('_token');

    	//dd($settings);

    	foreach( $settings as $key => $value ) 
    	{
    		\SoaUserSetting::set($key, $value);
    	}

    	\SoaUserSetting::save();

    	flash()->success(trans('admin::lang.save.edit'));
    	return redirect()->back();
    }

    public function getSettingsReset()
    {
    	$fields = [
    		'theme.skin'				=> config('admintheme.skin'),
    		'theme.fixed_layout'		=> config('admintheme.fixed_layout'),
    		'theme.boxed_layout'		=> config('admintheme.boxed_layout'),
    		'theme.sidebar_mini'		=> config('admintheme.sidebar_mini'),
    		'theme.toggle_sidebar'		=> config('admintheme.toggle_sidebar'),
    		'theme.sidebar_on_hover'	=> config('admintheme.sidebar_on_hover'),
    	];

    	foreach( $fields as $key => $value ) 
    	{
    		\SoaUserSetting::set($key, $value);
    	}

    	\SoaUserSetting::save();

    	flash()->success(trans('admin::lang.save.edit'));
    	return redirect()->back();
    }

	protected function cacheResponse(Response $response)
	{
		$response->setSharedMaxAge(31536000);
		$response->setMaxAge(31536000);
		$response->setExpires(new \DateTime('+1 year'));

		return $response;
	}

	public function getWildcard()
	{
		abort(404);
	}

}