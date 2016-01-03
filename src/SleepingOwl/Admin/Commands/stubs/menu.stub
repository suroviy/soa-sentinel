<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu()->label('User Management')->icon('fa-book')->items(function ()
{
    Admin::menu('SleepingOwl\Admin\Model\User')->icon('fa-user');
    Admin::menu('Cartalyst\Sentinel\Roles\EloquentRole')->icon('fa-users');
    Admin::menu('SleepingOwl\Admin\Model\Permission')->icon('fa-users');
    
});