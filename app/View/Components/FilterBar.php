<?php

namespace App\View\Components;

use App\Common\Config\MyConfig;
use App\Common\Helper\MyHelper;
use Illuminate\View\Component;

class FilterBar extends Component
{
    public $controller;
    public $filterData;
    public $filters;
    public $countFilters;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($controller, $filters, $filterData, $countFilters)
    {
        $this->controller = $controller;
        $this->filters = $filters;
        $this->filterData = $filterData;
        $this->countFilters = $countFilters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter-bar');
    }

    public function isSelected($field, $value)
    {
        return $value == $this->filters[$field];
    }

    public function getFilterLink($field, $key)
    {
        return route(
            MyHelper::toPlural($this->controller) . '.index',
            array_merge(
                app('request')->query(),
                [
                    'page' => 1,
                    MyHelper::convertFieldToFilterName($field) => $key
                ]
            )
        ); //sprintf('/admin/%s?%s=%s',  MyHelper::toPlural($this->controller),  MyHelper::convertFieldToFilterName($field), $key );
    }

    public function isSelectFilter($field, $data)
    {
        return strpos($field, '_id') || count($data) > 4;
    }

    public function getLabel($field)
    {
        // remove redundant
        return MyHelper::convertFieldToLabel($field);
    }
}
