<?php namespace SleepingOwl\Admin\Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use SleepingOwl\Admin\Model\Permission as PermissionModel;

class SentinelPermissionSeeder extends Seeder
{

	public function run()
	{		
		try
		{

			$permissions = [

				'superadmin'	=> [
					'default'		=> true,
					'description'	=> 'Super Admin'
				],
				'controlpanel'	=> [
					'default'		=> true,
					'description'	=> 'Access to the Control Panel'
				],
				'admin.users.view'	=> [
					'default'		=> true,
					'description'	=> 'View Users'
				],
				'admin.users.create'	=> [
					'default'		=> true,
					'description'	=> 'Create Users'
				],
				'admin.users.edit'	=> [
					'default'		=> true,
					'description'	=> 'Edit Users'
				],
				'admin.users.destroy'	=> [
					'default'		=> true,
					'description'	=> 'Delete Users'
				],
				'admin.roles.view'	=> [
					'default'		=> true,
					'description'	=> 'View Roles'
				],
				'admin.roles.create'	=> [
					'default'		=> true,
					'description'	=> 'Create Roles'
				],
				'admin.roles.edit'	=> [
					'default'		=> true,
					'description'	=> 'Edit Roles'
				],
				'admin.roles.destroy'	=> [
					'default'		=> true,
					'description'	=> 'Delete Roles'
				],
				'admin.permissions.view'	=> [
					'default'		=> true,
					'description'	=> 'View Permissions'
				],
				'admin.permissions.create'	=> [
					'default'		=> true,
					'description'	=> 'Create Permissions'
				],
				'admin.permissions.edit'	=> [
					'default'		=> true,
					'description'	=> 'Edit Permissions'
				],
				'admin.permissions.destroy'	=> [
					'default'		=> true,
					'description'	=> 'Delete Permissions'
				]

			];

			//create records
			foreach ($permissions as $key => $permission) {
				PermissionModel::create([
					'value' => $key, 
					'description' =>$permission['description']
				]);
			}


			$role = \Sentinel::findRoleByName('Administrator');

			//assign permissions to role
			foreach ($permissions as $key => $permission) {
				$role->addPermission($key, $permission['default']);
			}

			$role->save();
			
		} catch (\Exception $e) {
		
		}
	}
}