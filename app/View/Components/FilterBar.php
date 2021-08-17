<?php

namespace App\View\Components;

use App\Common\Config\MyConfig;
use App\Common\Helper\MyHelper;
use Illuminate\View\Component;

class FilterBar extends Component
{
    public $controller;
    public $filterData;
    public $countFilters;
    public $filters;

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
    public function getQty($field, $value)
    {
        return $this->countFilters[$field][$value];
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

    public function getSelectDataWithCount($field, $selectData)
    {
        $count = $this->countFilters[$field];
        $data = array_filter($selectData, function ($key) use ($count) {
            return  $count[$key] > 0;
        }, ARRAY_FILTER_USE_KEY);
        array_walk($data, function (&$a, $b) use ($count) {
            $a = sprintf('%s (%s)', $a, $count[$b]);
        });
        return ['all' => 'All'] + $data;
    }

    public function getLabel($field)
    {
        return ucfirst($field);
    }
}
