<?php

namespace App\View\Components;

use App\Common\Config\MyConfig;
use App\Common\Helper\MyHelper;
use Illuminate\View\Component;

class ManagementTable extends Component
{
    public $options;
    public $controller;
    public $theadData;
    public $tbodyData;
    public $pageParams;
    public $countFilters;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($controller, $theadData, $tbodyData, $pageParams, $countFilters, $options = [])
    {
        $this->controller = $controller;
        $this->theadData = $theadData;
        $this->tbodyData = $tbodyData;
        $this->options = $options;
        $this->pageParams = $pageParams;
        $this->countFilters = $countFilters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.management-table');
    }

    public function getThLabel($column)
    {
        $field = $column['field'];
        $label = $column['label'] ?? ucfirst($field);
        if ($this->hasSort()) {
            $sortFields = MyConfig::getItemDataForController($this->controller, 'sort');
            if (in_array($field, $sortFields)) {
                $sortField = $this->pageParams['sort']['field'];
                $sortValue = $this->pageParams['sort']['value'];
                $newSortValue = ($sortField === $field) ? ($sortValue === 'desc' ? 'asc' : 'desc') : 'desc';
                $icon = $sortField === $field ? $this->getThIcon($sortValue) : "";
                return sprintf(
                    '<a href="%s">%s %s</a>',
                    route(
                        MyHelper::toPlural($this->controller) . '.index',
                        array_merge(
                            app('request')->query(),
                            [
                                'sort_field' => $field,
                                'sort_value' => $newSortValue,
                            ]
                        )
                    ),
                    $label,
                    $icon
                );
            }
        }
        return $label;
    }

    public function getThIcon($value)
    {
        $iconClass = $value === 'desc' ? 'fa-caret-down' : 'fa-caret-up';
        return sprintf('<i class="fas %s fa-fw"> </i>', $iconClass);
    }

    public function getNameValue($row)
    {
        return $row[$this->options['nameField']];
    }

    // table value
    public function getTdValue($row,  $column)
    {
        $result = '';
        $field = $column['field'];
        $value = $row[$column['field']];
        $type = $column['type'] ?? '';

        switch ($type) {
            case 'time':
                $result = $this->getHistory($value);
                break;

            default:
                $result = $this->handleSearchingValue($field, $value);
                break;
        }

        return $result;
    }

    public function getHistory($value)
    {
        if ($value != null) {
            $icon = '<i class="fas fa-clock fa-fw"></i>';
            return sprintf('<div>%s <span>%s</span></div>', $icon,  date_format($value, 'd/m/Y'));
        }
        return '';
    }

    public function handleSearchingValue($field, $value)
    {
        if (!$this->hasSearch()) return $value;

        // 
        $searchField = trim($this->pageParams['search']['field']);
        $searchValue = trim($this->pageParams['search']['value']);

        if ($searchValue === '') return $value;
        $pattern = '/(' . $searchValue . ')/i';

        if ($searchField === 'all' || $field === $searchField)
            $value = preg_replace($pattern, '<span class="highlight">$1</span>', $value);
        return $value;
    }

    // search and filter
    public function hasFilter()
    {
        return  $this->options['hasFilter'] ?? false;
    }

    public function hasSearch()
    {
        return  $this->options['hasSearch'] ?? false;
    }

    public function hasSort()
    {
        return  $this->options['hasSort'] ?? false;
    }

    public function hasFilterOrSearch()
    {
        return $this->hasFilter() || $this->hasSearch();
    }
}
