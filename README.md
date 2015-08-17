#SleepingOwl Admin Panel with Sentinel Integration


## Laravel 5 Admin Module

[Official - Latest Stable Version](https://packagist.org/packages/sleeping-owl/admin)

[Official - Latest Development Version](https://packagist.org/packages/sleeping-owl/admin)

[Official - License](https://packagist.org/packages/sleeping-owl/admin)

*Note: This is not the official package! If you are looking for the official stable version check out [master branch](https://github.com/sleeping-owl/admin).*

SleepingOwl Admin is administrative interface builder for Laravel.

It includes:

 - [adminLTE template](https://almsaeedstudio.com/)
 - [jQuery 1.11.0](http://jquery.org)
 - [Bootstrap v3.2.0](http://getbootstrap.com)
 - [Chosen v1.4.2](http://harvesthq.github.io/chosen/)
 - [DataTables 1.10.0-dev](http://www.sprymedia.co.uk)
 - [Nestable jQuery Plugin](http://dbushell.github.io/Nestable/)
 - [Lightbox for Bootstrap 3](https://github.com/ashleydw/lightbox)
 - [Font Awesome 4.1.0](http://fontawesome.io)
 - [Metismenu 1.0.3](https://github.com/onokumus/metisMenu)
 - [morris.js v0.5.0]()
 - [bootbox.js v4.3.0](http://bootboxjs.com)
 - [Bootstrap datetimepicker](http://eonasdan.github.io/bootstrap-datetimepicker/)
 - [CKEditor](http://ckeditor.com)
 - [flow.js](https://github.com/flowjs/flow.js)
 - [Sentinel](https://cartalyst.com/manual/sentinel)

## Installation

 1. Require this package in your composer.json and run composer update:

Develop Branch:

	"pseudoagentur/soa-admin-sentinel": "dev-develop"

Master Branch:

        "pseudoagentur/soa-admin-sentinel": "dev-master"


 2. After composer update, add service providers to the `config/app.php`

	'Cartalyst\Sentinel\Laravel\SentinelServiceProvider',
        'SleepingOwl\Admin\AdminServiceProvider',

 3. Add this to the facades in `config/app.php`:

        'Activation'    => 'Cartalyst\Sentinel\Laravel\Facades\Activation',
        'Reminder'      => 'Cartalyst\Sentinel\Laravel\Facades\Reminder',
        'Sentinel'      => 'Cartalyst\Sentinel\Laravel\Facades\Sentinel',
        
        'Admin'         => 'SleepingOwl\Admin\Admin',
        'Column'        => 'SleepingOwl\Admin\Columns\Column',
        'ColumnFilter'  => 'SleepingOwl\Admin\ColumnFilters\ColumnFilter',
        'Filter'        => 'SleepingOwl\Admin\Filter\Filter',
        'AdminDisplay'  => 'SleepingOwl\Admin\Display\AdminDisplay',
        'AdminForm'     => 'SleepingOwl\Admin\Form\AdminForm',
        'AdminTemplate' => 'SleepingOwl\Admin\Templates\Facade\AdminTemplate',
        'FormItem'      => 'SleepingOwl\Admin\FormItems\FormItem',

 4. Run this command in terminal:

		$ php artisan admin:install

		

## Documentation

* SleepingOwl: Documentation can be found at [sleeping owl documentation](http://sleeping-owl.github.io/v3).
* Sentinel: Documentation can be found at [cartalyst documentation](https://cartalyst.com/manual/sentinel).

## Demo Application

View [Official - live demo](http://sleepingowladmindemo2.cloudcontrolled.com).

## Copyright and License

Admin was written by Sleeping Owl for the Laravel framework and is released under the MIT License. See the LICENSE_SOA file for details.

Sentinel was written by Cartalyst for the Laravel framework and is released under the BSD 3-Clause License. See the LICENSE_SENTINEL file for details.