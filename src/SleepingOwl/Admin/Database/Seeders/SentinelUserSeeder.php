<?php namespace SleepingOwl\Admin\Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;

class SentinelUserSeeder extends Seeder
{

	public function run()
	{		
		try
		{

			$role = \Sentinel::findRoleByName('Administrator');

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