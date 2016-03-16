<?php namespace SleepingOwl\Admin\Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;

class SentinelRoleSeeder extends Seeder
{

	public function run()
	{		
		try
		{
			$role = \Sentinel::getRoleRepository()->createModel()->create([
			    'name' => 'Administrator',
			    'slug' => 'administrator',
			]);		
		} catch (\Exception $e) {
		}
	}
}