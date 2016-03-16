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
					'description'	=> 'Super Admin',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'controlpanel'	=> [
					'default'		=> true,
					'description'	=> 'Access to the Control Panel',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.users.view'	=> [
					'default'		=> true,
					'description'	=> 'View Users',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.users.create'	=> [
					'default'		=> true,
					'description'	=> 'Create Users',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.users.edit'	=> [
					'default'		=> true,
					'description'	=> 'Edit Users',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.users.destroy'	=> [
					'default'		=> true,
					'description'	=> 'Delete Users',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.roles.view'	=> [
					'default'		=> true,
					'description'	=> 'View Roles',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.roles.create'	=> [
					'default'		=> true,
					'description'	=> 'Create Roles',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.roles.edit'	=> [
					'default'		=> true,
					'description'	=> 'Edit Roles',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.roles.destroy'	=> [
					'default'		=> true,
					'description'	=> 'Delete Roles',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.permissions.view'	=> [
					'default'		=> true,
					'description'	=> 'View Permissions',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.permissions.create'	=> [
					'default'		=> true,
					'description'	=> 'Create Permissions',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.permissions.edit'	=> [
					'default'		=> true,
					'description'	=> 'Edit Permissions',
					'group_name'	=> 'admin::lang.permission.without_group'
				],
				'admin.permissions.destroy'	=> [
					'default'		=> true,
					'description'	=> 'Delete Permissions',
					'group_name'	=> 'admin::lang.permission.without_group'
				]

			];

			//create records
			foreach ($permissions as $key => $permission) {
				PermissionModel::create([
					'value' 		=> $key, 
					'description' 	=> $permission['description'],
					'group_name'	=> $permission['group_name']
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