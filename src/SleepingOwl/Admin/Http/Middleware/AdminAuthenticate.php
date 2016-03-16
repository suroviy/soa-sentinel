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
		$custom_routes = config('admin.custom_routes');
		$system_route = false;
		$route_name = $request->route()->getName();
		$route_parameters = $request->route()->parameters();
		
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

		if( $route_name == "admin.logout" ) {
			return $next($request);
		}
		if(starts_with($route_name, "elfinder.") || starts_with($route_name, "admin.upload.") || starts_with($route_name, 'admin.settings') ){
			$system_route = true;
		}

		if( array_key_exists($route_name, $custom_routes ) || $system_route ) {
			$config_permissions = (!$system_route) ? $custom_routes[$route_name]['permission'] : null;
			$check_permissions = (!empty($config_permissions)) ? $config_permissions : config('admin.defaultPermission');

			if (\Sentinel::hasAnyAccess($check_permissions))
			{
				return $next($request);
			}
			elseif ( array_key_exists('logout', $custom_routes[$route_name]) && $custom_routes[$route_name]['logout'] ) {
				\Sentinel::logout(null, true);
				return redirect()->guest(route('admin.login'));
			}
		} else {

			//use dynamic permissions
			$route_alias = explode(".",$route_name);

			if ( !isset($route_alias[2]) ) {
				$route_alias[2] = 'view';
			} elseif ( $route_alias[2] == 'update' ) {
				$route_alias[2] = 'edit';
			}  elseif ( $route_alias[2] == 'store' ) {
				$route_alias[2] = 'create';
			} else {
				$route_alias[2];
			}

			if ( is_null( $route_parameters['adminModel']->permission() ) ) {

				if( $route_alias[2] == "view" ) {
					$model_permissions = [
						"admin.".$route_parameters['adminModel']->alias().".view"
					];
				} else {
					$model_permissions = [
						"admin.".$route_parameters['adminModel']->alias().".".$route_alias[2]
					];
				}
			} else {
				$model_permissions 		= explode(",", $route_parameters['adminModel']->permission() );

				if( $route_alias[2] == "view" ) {
					$model_permissions[] 	= "admin.".$route_parameters['adminModel']->alias().".view";
				} else {
					$model_permissions[] 	= "admin.".$route_parameters['adminModel']->alias().".".$route_alias[2];
				}
			}

			$model_permissions[] 	= "superadmin";

			if (\Sentinel::hasAnyAccess($model_permissions))
			{
				return $next($request);
			}
		}
		flash()->error(trans('admin::lang.permission.denied'));
		return redirect()->route('admin.dashboard');
	}
}