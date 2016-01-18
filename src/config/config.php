<?php

return [
	/*
	 * Admin title
	 * Displays in page title and header
	 */
	'title'                   => 'SOA Backend',
	'title-mini'              => 'SOA',

	/*
	 * Admin url prefix
	 */
	'prefix'                  => 'admin',

	/*
	 * Middleware to use in admin routes
	 */
	'middleware'              => ['admin.language','admin.auth'],

	/*
	 * Default Permissions to Check
	 */
	'defaultPermission' => [
		'superadmin',
		'controlpanel'
	],

	/*
	 * Models
	 */
	'models' => [
		'permission' => 'SleepingOwl\Admin\Model\Permission'
	],

	/*
	 * Path to admin bootstrap files directory
	 * Default: app_path('Admin')
	 */
	'bootstrapDirectory'      => app_path('Admin'),

	/*
	 * Directory to upload images to (relative to public directory)
	 * OUTDATED: Use filemanagerDirectory instead
	 */
	'imagesUploadDirectory' => 'images/uploads',

	/*
	 * Directory for file manager  (relative to public directory)
	 */
	'filemanagerDirectory' =>  'files/',

	/*
	 * Popup elfinder file manager url 
	 * 
	 */
	'elfinderPopupUrl' => [
		"type" 	=> "url",
		"path"	=> "elfinder/popup" 
	],

	/*
	 * Authentication config
	 */
	'auth'                    => [
		'model' => '\SleepingOwl\AdminAuth\Entities\Administrator',
		'rules' => [
			'email' => 'required',
			'password' => 'required',
		]
	],

	/*
	 * Is language switcher present?
	 */
	'language_switcher'	=> false,

	/*
	 * Available languages
	 */
	'languages'	=> [

		'de'	=> "German",
		'en'	=> "English",
		'es'	=> "Spanish",
		'pt_BR'	=> "Portoguese",
		'ru'	=> "Russian",
		'uk'	=> "Ukrainian"

	],

	/*
	 * Template to use
	 */
	'template'                => 'SleepingOwl\Admin\Templates\TemplateDefault',

	/*
	 * Prefix for icon font
	 */
	'icon_prefix' 	=> 'fa',

	/*
	 * Icon Font Tag
	 */
	'icon_tag' 		=> '<i class="%s"></i>',

	/*
	 * Used Icon Fonts
	 */
	'icons' => [
		'flag' => 'fa-flag-o',
		'user' => 'fa-user',
		'create' => 'fa-plus',
		'edit' => 'fa-pencil',
		'delete' => 'fa-times',
		'restore' => 'fa-reply',
		'menu_dropdown' => 'fa-angle-left',
		'goto_filter' => 'fa-arrow-circle-o-right',
		'datepicker' => 'fa-clock-o',
		'timepicker' => 'fa-clock-o',
		'file' => 'fa-file-o',
		'file_remove' => 'fa-upload',
		'file_upload' => 'fa-times',
		'filter_self' => 'fa-filter'
	],

	/*
	 * Default date and time formats
	 */
	'datetimeFormat'          => 'd.m.Y H:i',
	'dateFormat'              => 'd.m.Y',
	'timeFormat'              => 'H:i',

	/*
	 * If you want, you can extend ckeditor default configuration
	 * with this PHP Hash variable.
	 *
	 * Checkout http://docs.ckeditor.com/#!/api/CKEDITOR.config for more information.
	 */
	'ckeditor' => [
		'filebrowserBrowseUrl' 		=> [
			"type" 	=> "url",
			"path"	=> "elfinder/ckeditor" 
		],
		'filebrowserImageBrowseUrl' => [
			"type" 	=> "url",
			"path"	=> "elfinder/ckeditor" 
		]
	],
	
	/**
	 * If you are using tinymce as WYSIWYG editor you can enable here the elfinder javascript to use elfinder with tinymce.
	 */
	
	'tinymce' => [
		'enable_elfinder' => false
	],

	/**
	 * Define here your custom route with permissions, so that we can handle them
	 * Format: route_name => ['permission' => '', 'logout' => false]
	 * When you leave permission empty, we default using the defaultPermission array in this config
	 */
	'custom_routes' => [
		'admin.dashboard'    => [ 'permission' => '', 'logout' => true ]
	]
];
