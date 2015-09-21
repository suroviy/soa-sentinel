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
	'middleware'              => ['admin.auth'],

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
	 * Template to use
	 */
	'template'                => 'SleepingOwl\Admin\Templates\TemplateDefault',


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
];
