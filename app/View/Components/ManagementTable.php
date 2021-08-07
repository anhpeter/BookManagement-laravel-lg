<?php

namespace App\View\Components;

use App\Common\Helper\MyHelper;
use Illuminate\View\Component;

class ManagementTable extends Component
{
    public $options;
    public $controller;
    public $theadData;
    public $tbodyData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($controller, $theadData, $tbodyData, $options = [])
    {
        $this->controller = $controller;
        $this->theadData = $theadData;
        $this->tbodyData = $tbodyData;
        $this->options = $options;
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
        return $column['label'] ?? ucfirst($column['field']);
    }

    public function getNameValue($row)
    {
        return $row[$this->options['nameField']];
    }
}
