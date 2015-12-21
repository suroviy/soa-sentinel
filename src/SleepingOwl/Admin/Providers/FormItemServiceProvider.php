<?php namespace SleepingOwl\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use SleepingOwl\Admin\FormItems\FormItem;

class FormItemServiceProvider extends ServiceProvider
{

	public function register()
	{
		FormItem::register('columns', 'SleepingOwl\Admin\FormItems\Columns');
		FormItem::register('text', 'SleepingOwl\Admin\FormItems\Text');
		FormItem::register('time', 'SleepingOwl\Admin\FormItems\Time');
		FormItem::register('date', 'SleepingOwl\Admin\FormItems\Date');
		FormItem::register('timestamp', 'SleepingOwl\Admin\FormItems\Timestamp');
		FormItem::register('textaddon', 'SleepingOwl\Admin\FormItems\TextAddon');
		FormItem::register('select', 'SleepingOwl\Admin\FormItems\Select');
		FormItem::register('chosen', 'SleepingOwl\Admin\FormItems\Chosen');
		FormItem::register('bsselect', 'SleepingOwl\Admin\FormItems\BootstrapSelect');
		FormItem::register('bsselect2', 'SleepingOwl\Admin\FormItems\Select2');
		FormItem::register('multiselect', 'SleepingOwl\Admin\FormItems\MultiSelect');
		FormItem::register('hidden', 'SleepingOwl\Admin\FormItems\Hidden');
		FormItem::register('checkbox', 'SleepingOwl\Admin\FormItems\Checkbox');
		FormItem::register('ckeditor', 'SleepingOwl\Admin\FormItems\CKEditor');
		FormItem::register('custom', 'SleepingOwl\Admin\FormItems\Custom');
		FormItem::register('password', 'SleepingOwl\Admin\FormItems\Password');
		FormItem::register('sentinelpassword', 'SleepingOwl\Admin\FormItems\SentinelPassword');
		FormItem::register('textarea', 'SleepingOwl\Admin\FormItems\Textarea');
		FormItem::register('view', 'SleepingOwl\Admin\FormItems\View');
		FormItem::register('image', 'SleepingOwl\Admin\FormItems\Image');
		FormItem::register('images', 'SleepingOwl\Admin\FormItems\Images');
		FormItem::register('file', 'SleepingOwl\Admin\FormItems\File');
		FormItem::register('radio', 'SleepingOwl\Admin\FormItems\Radio');
		FormItem::register('tinymce', 'SleepingOwl\Admin\FormItems\TinyMCE');
		FormItem::register('filemanager', 'SleepingOwl\Admin\FormItems\Filemanager');
		FormItem::register('colorpicker', 'SleepingOwl\Admin\FormItems\Colorpicker');
		FormItem::register('permissions', 'SleepingOwl\Admin\FormItems\Permissions');
		FormItem::register('roles', 'SleepingOwl\Admin\FormItems\Roles');

		FormItem::register('icheckbox', 'SleepingOwl\Admin\FormItems\ICheckbox');
		FormItem::register('iradio', 'SleepingOwl\Admin\FormItems\IRadio');

		FormItem::register('switchradio', 'SleepingOwl\Admin\FormItems\SwitchRadio');
		FormItem::register('switchcheckbox', 'SleepingOwl\Admin\FormItems\SwitchCheckbox');

		FormItem::register('typeahead', 'SleepingOwl\Admin\FormItems\Typeahead');
	}

}