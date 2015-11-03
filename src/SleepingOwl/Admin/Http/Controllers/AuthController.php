<?php namespace SleepingOwl\Admin\Http\Controllers;

use AdminTemplate;
use App;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Input;
use Redirect;
use SleepingOwl\AdminAuth\Facades\AdminAuth;
use Validator;

class AuthController extends Controller
{

	protected function redirect()
	{
		return Redirect::route('admin.wildcard', '/');
	}

	public function getLogin()
	{
		if ( \Sentinel::check() )
		{
			return $this->redirect();
		}
		$loginPostUrl = route('admin.login.post');
		return view(\AdminTemplate::view('pages.login'), [
			'title' => config('admin.title'),
			'loginPostUrl' => $loginPostUrl,
		]);
	}

	public function postLogin()
	{
		$rules = config('admin.auth.rules');
		$data = \Input::only(array_keys($rules));
		$lang = trans('admin::validation');
		if ($lang == 'admin::validation')
		{
			$lang = [];
		}
		$validator = \Validator::make($data, $rules, $lang);
		if ($validator->fails())
		{
			return \Redirect::back()->withInput()->withErrors($validator);
		}

		if (\Sentinel::authenticate($data))
		{

			if( \Sentinel::hasAnyAccess(['superadmin', 'controlpanel']) ){
				return \Redirect::intended(route('admin.wildcard', '/'));
			} else {
				return $this->getLogout();
			}
		}


		$message = new MessageBag([
			'email' => trans('admin::lang.auth.wrong-email'),
			'password' => trans('admin::lang.auth.wrong-password')
		]);

		return \Redirect::back()->withInput()->withErrors($message);
	}

	public function getLogout()
	{
		\Sentinel::logout(null, true);
		return redirect()->route('admin.login');
	}

}