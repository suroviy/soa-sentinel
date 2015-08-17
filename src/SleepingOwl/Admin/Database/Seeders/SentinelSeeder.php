<?php namespace SleepingOwl\Admin\Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;

class SentinelSeeder extends Seeder
{

	public function run()
	{		
		try
		{
			$role = \Sentinel::getRoleRepository()->createModel()->create([
			    'name' => 'Administrator',
			    'slug' => 'administrator',
			]);

			$role = \Sentinel::findRoleByName('Administrator');

			$role->permissions = [
			    'superadmin' 			=> true,
			    'controlpanel' 			=> true,
			    
			    'admin.users.view' 		=> true,
			    'admin.users.create' 	=> true,
			    'admin.users.edit' 		=> true,
			    'admin.users.destroy' 	=> true,
			    
			    'admin.roles.view' 		=> true,
			    'admin.roles.create' 	=> true,
			    'admin.roles.edit' 		=> true,
			    'admin.roles.destroy' 	=> true,
			];

			$role->save();


			$credentials = [
			    'email'    => 'admin@soa.backend',
			    'password' => 'password',
			];

			$user = \Sentinel::create($credentials);

			$role->users()->attach($user);

			$activation = \Activation::create($user);

			$activation_complete = \Activation::complete($user, $activation->code);
			
		} catch (\Exception $e)
		{
		}

		

	}

}