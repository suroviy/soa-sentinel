<?php namespace SleepingOwl\Admin\FormItems;

use Exception;
use Input;
use Route;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Interfaces\WithRoutesInterface;
use SplFileInfo;
use stdClass;
use Symfony\Component\Finder\Finder;

class TinyMCE extends NamedFormItem
{

    protected $view = 'tinymce';
    protected $mceConfig;
    protected $mceSelector = 'tinymce';

    public function initialize()
    {
        parent::initialize();

        AssetManager::addScript('admin::default/plugins/tinymce/tinymce.min.js');
    }

    public function mce_config($config=null)
    {
        if (is_null($config))
        {
            $this->mceConfig = array_add($this->mceConfig, 'selector', '#' . $this->mce_selector());
            return $this->mceConfig;
        }

        $this->mceConfig = $config;
        return $this;
    }

    public function mce_selector($selector=null) {
        if (is_null($selector))
        {
            return $this->mceSelector;
        }

        $this->mceSelector = $selector;
        return $this;
    }

    public function getParams()
    {
        return parent::getParams() + [
          'config' => str_replace('"elFinderBrowser"', 'elFinderBrowser', json_encode($this->mce_config() )),
          'selector' => $this->mce_selector(),
        ];
    }
}