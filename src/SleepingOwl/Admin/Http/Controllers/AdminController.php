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

class AdminController extends Controller
{

	public function getDisplay($model)
	{
		//added redirect to redirect back to the last model
		if( !is_null( \Request::input('_action') ) ) {
			//return back();
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

	public function postStore($model)
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
					'_redirectBack' => Input::get('_redirectBack'),
				]);
			}

			if ( !$create instanceof FormDefault || $create->storable() ) {
				$create->save($model);
			} elseif ( !$create->storable() && !is_null($create->event_handler())) {
				$reflect  = new ReflectionClass($create->event_handler());
				$instance = $reflect->newInstance($create, \Input::all());
				\Event::fire($instance);
			} else {
				abort(500, 'Please define form storable as true or set the event handler for storage.');
			};
		}
		flash()->success(trans('admin::lang.save.create'));
		return Redirect::to(Input::get('_redirectBack', $model->displayUrl()));
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

	public function postUpdate($model, $id)
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
					'_redirectBack' => Input::get('_redirectBack'),
				]);
			}

			if ( !$edit instanceof FormDefault || $edit->storable() ) {
				$edit->save($model);
			} elseif ( !$edit->storable() && !is_null($edit->event_handler())) {
				$reflect  = new ReflectionClass($edit->event_handler());
				$instance = $reflect->newInstance($edit, \Input::all());
				\Event::fire($instance);
			} else {
				abort(500, 'Please define form storable as true or set the event handler for storage.');
			};
		}
		flash()->success(trans('admin::lang.save.edit'));
		return Redirect::to(Input::get('_redirectBack', $model->displayUrl()));
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