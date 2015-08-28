<?php namespace SleepingOwl\Admin\Http\Middleware;

use Closure;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Model\ModelConfiguration;


class AdminAuthenticate
{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!\Sentinel::check())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			} else
			{
				return redirect()->guest(route('admin.login'));
			}
		}

		if( $request->route()->getName() == "admin.logout" ) {
			return $next($request);
		}

		if( count( $request->route()->parameters() ) == 0 ) {

			//Dashboard or some custom page
			if( $request->route()->getName() == "admin.dashboard" || starts_with($request->route()->getName(), "admin.formitems.image.")) {
				if (\Sentinel::hasAnyAccess(['superadmin', 'controlpanel']))
				{
					return $next($request);
				}
			}

		} else {

			//use dynamic permissions
			$route_alias = explode(".",$request->route()->getName());
			$route_alias[2] = (!isset($route_alias[2])) ? "view" : $route_alias[2];

			if ( is_null( $request->route()->parameters()['adminModel']->permission() ) ) {

				if( $route_alias[2] == "view" ) {
					$model_permissions = [
						"admin.".$request->route()->parameters()['adminModel']->alias().".*"
					];
				} else {
					$model_permissions = [
						"admin.".$request->route()->parameters()['adminModel']->alias().".".$route_alias[2]
					];
				}
			} else {
				$model_permissions 		= explode(",", $request->route()->parameters()['adminModel']->permission() );

				if( $route_alias[2] == "view" ) {
					$model_permissions[] 	= "admin.".$request->route()->parameters()['adminModel']->alias().".*";
				} else {
					$model_permissions[] 	= "admin.".$request->route()->parameters()['adminModel']->alias().".".$route_alias[2];
				}
			}

			$model_permissions[] 	= "superadmin";

			if (\Sentinel::hasAnyAccess($model_permissions))
			{
				return $next($request);
			}
		}

		return redirect()->route('admin.dashboard')->withErrors('Permission denied.');
	}
}