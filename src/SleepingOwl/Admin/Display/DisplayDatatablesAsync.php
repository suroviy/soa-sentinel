<?php namespace SleepingOwl\Admin\Display;

use AdminTemplate;
use Carbon\Carbon;
use Input;
use Route;
use Illuminate\Http\Request;
use SleepingOwl\Admin\ColumnFilters\Date;
use SleepingOwl\Admin\Columns\Column\DateTime;
use SleepingOwl\Admin\Columns\Column\NamedColumn;
use SleepingOwl\Admin\Columns\Column\ColumnString;
use SleepingOwl\Admin\Interfaces\WithRoutesInterface;

class DisplayDatatablesAsync extends DisplayDatatables implements WithRoutesInterface
{

	/**
	 * Datatables name
	 * @var string
	 */
	protected $name;

	/**
	 * @param string|null $name
	 */
	function __construct($name = null, $distinct=null)
	{
		$this->name($name);
		$this->distinct=$distinct;
	}

	/**
	 * Register display routes
	 */
	public static function registerRoutes()
	{
		Route::get('{adminModel}/async/{adminDisplayName?}', [
			'as' => 'admin.model.async',
			function ($model, $name = null)
			{
				$display = $model->display();
				if ($display instanceof DisplayTabbed)
				{
					$display = static::findDatatablesAsyncByName($display, $name);
				}
				if ($display instanceof DisplayDatatablesAsync)
				{
					return $display->renderAsync();
				}
				abort(404);
			}
		]);
	}

	/**
	 * Find DisplayDatatablesAsync in tabbed display by name
	 * @param DisplayTabbed $display
	 * @param string|null $name
	 * @return DisplayDatatablesAsync|null
	 */
	protected static function findDatatablesAsyncByName(DisplayTabbed $display, $name)
	{
		$tabs = $display->tabs();
		foreach ($tabs as $tab)
		{
			$content = $tab->getOriginalContent();
			if ($content instanceof DisplayDatatablesAsync && $content->name() === $name)
			{
				return $content;
			}
		}
		return null;
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		$params = $this->getParams();
		$attributes = \Request::all();
		array_unshift($attributes, $this->name());
		array_unshift($attributes, $this->model()->alias());
		$params['url'] = route('admin.model.async', $attributes);
		return view(AdminTemplate::view('display.datatablesAsync'), $params);
	}

	/**
	 * Render async request
	 * @return array
	 */
	public function renderAsync()
	{
		$query = $this->repository->query();
		$totalCount = $query->count();

		$this->modifyQuery($query);
		$this->applySearch($query);
		$this->applyColumnSearch($query);


		if(!is_null($this->distinct)){
			$filteredCount = $query->distinct()->count($this->distinct);
		}

		if(is_null($this->distinct)){
			$filteredCount = $query->count();
		}

		$this->applyOrders($query);
		$this->applyOffset($query);
		$collection = $query->get();

		return $this->prepareDatatablesStructure($collection, $totalCount, $filteredCount);
	}

	/**
	 * Apply offset and limit to the query
	 * @param $query
	 */
	protected function applyOffset($query)
	{
		$offset = \Request::input('start', 0);
		$limit = \Request::input('length', 10);
		if ($limit == -1)
		{
			return;
		}
		$query->offset($offset)->limit($limit);
	}

	/**
	 * Apply orders to the query
	 * @param $query
	 */
	protected function applyOrders($query)
	{
		$orders = \Request::input('order', []);
		foreach ($orders as $order)
		{
			$columnIndex = $order['column'];
			$orderDirection = $order['dir'];
			$column = $this->allColumns()[$columnIndex];
			if ($column instanceof NamedColumn && $column->isOrderable())
			{
				$name = $column->name();
				$query->orderBy($name, $orderDirection);
			}
		}
	}

	/**
	 * Apply search to the query
	 * @param $query
	 */
	protected function applySearch($query)
	{
		$search = \Request::input('search.value');
		if (is_null($search))
		{
			return;
		}

		$dtColumns = \Request::input('columns', []);

		$query->where(function ($query) use ($search, $dtColumns)
		{

			$columns = $this->columns();
			foreach ($columns as $key => $column)
			{
				if ($column instanceof ColumnString)
				{
					$searchable = array_get($dtColumns[$key], 'searchable');	
					$name 		= $column->name();
					
					if ($this->repository->hasColumn($name))
					{
						if( $searchable == "true" ) {
							$query->orWhere($name, 'like', '%' . $search . '%');
						}
					}	
				}
			}
		});
	}

	protected function applyColumnSearch($query)
	{
		$queryColumns = \Request::input('columns', []);
		foreach ($queryColumns as $index => $queryColumn)
		{
			$search = array_get($queryColumn, 'search.value');
			$fullSearch = array_get($queryColumn, 'search');
			$searchable = array_get($queryColumn, 'searchable');
			$column = array_get($this->columns(), $index);
			$columnFilter = array_get($this->columnFilters(), $index);
			if ( ! is_null($columnFilter) && $searchable == "true" )
			{
				$columnFilter->apply($this->repository, $column, $query, $search, $fullSearch);
			}
		}
	}

	/**
	 * Convert collection to the datatables structure
	 *
	 * @param $collection
	 * @param $totalCount
	 * @param $filteredCount
	 * @return array
	 */
	protected function prepareDatatablesStructure($collection, $totalCount, $filteredCount)
	{
		$columns = $this->allColumns();

		$result = [];
		$result['draw'] = \Request::input('draw', 0);
		$result['recordsTotal'] = $totalCount;
		$result['recordsFiltered'] = $filteredCount;
		$result['data'] = [];
		foreach ($collection as $instance)
		{
			$_row = [];
			foreach ($columns as $column)
			{
				$column->setInstance($instance);
				$_row[] = (string)$column;
			}
			$result['data'][] = $_row;
		}
		return $result;
	}

	/**
	 * Get or set datatables name
	 * @param null $name
	 * @return $this
	 */
	public function name($name = null)
	{
		if (is_null($name))
		{
			return $this->name;
		}
		$this->name = $name;
		return $this;
	}

}