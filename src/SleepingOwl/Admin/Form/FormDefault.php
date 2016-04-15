<?php namespace SleepingOwl\Admin\Form;

use AdminTemplate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Input;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\FormItems\Columns;
use SleepingOwl\Admin\Interfaces\DisplayInterface;
use SleepingOwl\Admin\Interfaces\FormInterface;
use SleepingOwl\Admin\Interfaces\FormItemInterface;
use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Repository\BaseRepository;
use URL;
use Validator;

class FormDefault implements Renderable, DisplayInterface, FormInterface
{

	/**
	 * View to render
	 * @var string
	 */
	protected $view = 'default';
	/**
	 * Form related class
	 * @var string
	 */
	protected $class;
	/**
	 * Form related repository
	 * @var BaseRepository
	 */
	protected $repository;
	/**
	 * Form items
	 * @var FormItemInterface[]
	 */
	protected $items = [];
	/**
	 * Form action url
	 * @var string
	 */
	protected $action;
	/**
	 * Form related model instance
	 * @var mixed
	 */
	protected $instance;
	/**
	 * Currently loaded model id
	 * @var int
	 */
	protected $id;
	/**
	 * Is form already initialized?
	 * @var bool
	 */
	protected $initialized = false;

	/**
	 * Use Eloquent's push method instead of save. 
	 * This will enable relationship saving. 
	 * @var boolean
	 */
	protected $usePush = false;

	protected $horizontal = false;
	protected $label_size = "col-sm-2";
	protected $field_size = "col-sm-10";
	protected $ajax_validation = false;
	protected $storable = true;
	protected $event_handler = null;
	protected $back_url;
	protected $validation_rules = null;
	protected $validation_messages = null;

	/**
	 * Initialize form
	 */
	public function initialize()
	{
		if ($this->initialized) return;

		$this->initialized = true;
		$this->repository = new BaseRepository($this->class);
		$this->instance(app($this->class));
		$items = $this->items();
		array_walk_recursive($items, function ($item)
		{
			if ($item instanceof FormItemInterface)
			{
				$item->initialize();
			}
		});
	}

	/**
	 * Set form action
	 * @param string $action
	 */
	public function setAction($action)
	{
		if (is_null($this->action))
		{
			$this->action = $action;
		}
	}

	/**
	 * Set form class
	 * @param string $class
	 */
	public function setClass($class)
	{
		if (is_null($this->class))
		{
			$this->class = $class;
		}
	}

	public function horizontal($horizontal = null)
	{
		if (is_null($horizontal))
		{
			return $this->horizontal;
		}
		$this->horizontal = $horizontal;
		return $this;
	}

	public function label_size($label_size = null)
	{
		if (is_null($label_size))
		{
			return ($this->horizontal) ? $this->label_size : null;
		}
		$this->label_size = ($this->horizontal) ? $label_size : null;
		return $this;
	}

	public function field_size($field_size = null)
	{
		if (is_null($field_size))
		{
			return ($this->horizontal) ? $this->field_size : null;
		}
		$this->field_size = ($this->horizontal) ? $field_size : null;
		return $this;
	}

	public function ajax_validation($ajax_validation = null)
	{
		if (is_null($ajax_validation)) {

			if ($this->ajax_validation) {
				AssetManager::addScript(asset('vendor/jsvalidation/js/jsvalidation.js'));
				return \JsValidator::make($this->build_validation_rules(), [], $this->build_validation_messages());
			} else {
				return false;
			}
		}
		$this->ajax_validation = $ajax_validation;
		return $this;
	}

	public function storable($storable = null)
	{
		if (is_null($storable))
		{
			return $this->storable;
		}
		$this->storable = $storable;
		return $this;
	}

	public function usePush($usePush = null) 
	{
		if (is_null($usePush))
		{
			return $this->usePush;
		}

		$this->usePush = $usePush;
		return $this;
	}

	public function event_handler($eventHandler = null)
	{

		if (is_null($eventHandler))
		{
			return $this->event_handler;
		}

		$this->event_handler = $eventHandler;
		return $this;
	}

	/**
     * @param null $url URL or route name
     * @param array $params optional url / route params
     * @return mixed
     */
    public function back_url($url = null, $params = []) {
        if (is_null($url)) {
            return (is_null($this->back_url)) ? session('_redirectBack', URL::previous()) : $this->back_url;
        }

        if ( \Route::has($url)) {
            $this->back_url = route($url, $params);
        } else {
            $this->back_url = url($url, $params);
        }

		return $this;
    }

	/**
	 * Get or set form items
	 * @param FormInterface[]|null $items
	 * @return $this|FormInterface[]
	 */
	public function items($items = null)
	{
		if (is_null($items))
		{
			return $this->items;
		}
		$this->items = $items;
		return $this;
	}

	/**
	 * Get or set form related model instance
	 * @param mixed|null $instance
	 * @return $this|mixed
	 */
	public function instance($instance = null)
	{
		if (is_null($instance))
		{
			return $this->instance;
		}
		$this->instance = $instance;
		$items = $this->items();
		array_walk_recursive($items, function ($item) use ($instance)
		{
			if ($item instanceof FormItemInterface)
			{
				$item->setLabelSize($this->label_size());
				$item->setFieldSize($this->field_size());
				$item->setInstance($instance);
			}
		});
		return $this;
	}

	/**
	 * Set currently loaded model id
	 * @param int $id
	 */
	public function setId($id)
	{
		if (is_null($this->id))
		{
			$this->id = $id;
			$this->instance($this->repository->find($id));
		}
	}

	/**
	 * Get related form model configuration
	 * @return ModelConfiguration
	 */
	public function model()
	{
		return Admin::model($this->class);
	}

	/**
	 * Save instance
	 * @param $model
	 */
	public function save($model)
	{

		if ($this->model() != $model)
		{
			return null;
		}

		$items = $this->items();
		array_walk_recursive($items, function ($item)
		{
			if ($item instanceof FormItemInterface)
			{
				$item->save();
			}
		});

		if ($this->usePush) 
		{
			$this->instance()->push();
		}
		else 
		{
			$this->instance()->save();
		}		
	}

	/**
	 * Validate data, returns null on success
	 * @param mixed $model
	 * @return Validator|null
	 */
	public function validate($model)
	{
		if ($this->model() != $model)
		{
			return null;
		}

		$data = \Request::all();
		$verifier = app('validation.presence');
		$verifier->setConnection($this->instance()->getConnectionName());
		$validator = Validator::make($data, $this->build_validation_rules(), [], $this->build_validation_messages());
		$validator->setPresenceVerifier($verifier);
		if ($validator->fails())
		{
			return $validator;
		}
		return null;
	}

	/**
	 * @return View
	 */
	public function render()
	{
		$params = [
			'items'    => $this->items(),
			'instance' => $this->instance(),
			'action'   => $this->action,
			'backUrl'  => $this->back_url(),
			'horizontal'	=> $this->horizontal(),
			'label_size'	=> $this->label_size(),
			'field_size'	=> $this->field_size(),
			'ajax_validation' => $this->ajax_validation(),
		];
		return view(AdminTemplate::view('form.' . $this->view), $params);
	}

	/**
	 * @return string
	 */
	function __toString()
	{
		return (string)$this->render();
	}

	private function build_validation_rules()
	{
		if (is_null($this->validation_rules)) {
			$rules = [];
			$items = $this->items();
			array_walk_recursive($items, function ($item) use (&$rules) {
				if ($item instanceof FormItemInterface) {
					$rules += $item->getValidationRules();
				}
			});

			$this->validation_rules = $rules;
		}

		return $this->validation_rules;
	}

	private function build_validation_messages()
	{
		if (is_null($this->validation_messages)) {
			$names = [];
			$items = $this->items();
			array_walk_recursive($items, function ($item) use (&$names) {

				if ($item instanceof FormItemInterface && !$item->custom() ) {
					if ( $item instanceof Columns ) {

						foreach ($item->columns() as $columnItems)
						{
							foreach ($columnItems as $columnItem)
							{
								if ($columnItem instanceof FormItemInterface && !$columnItem->custom() )
								{
									$names = array_add($names, $columnItem->path(), $columnItem->label());
								}
							}
						}
					} else {
						$names = array_add($names, $item->path(), $item->label());
					}
				}
			});

			$this->validation_messages = $names;
		}

		return $this->validation_messages;
	}

}