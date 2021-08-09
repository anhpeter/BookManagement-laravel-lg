<?php

namespace App\View\Components;

use App\Common\Config\MyConfig;
use App\Common\Helper\MyHelper;
use Illuminate\View\Component;

class Status extends Component
{
    public $field = 'status';
    public $controller;
    public $id;
    public $value;
    public $template;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($controller, $id, $value)
    {
        $this->controller = $controller;
        $this->id = $id;
        $this->value = $value;
        $this->template = MyConfig::getTemplate()[$this->field][$value];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.status');
    }

    public function getLink()
    {
        $newValue = $this->value == 'active' ? 'inactive' : 'active';
        return route(
            MyHelper::toPlural($this->controller) . '.' . $this->field,
            array_merge(
                app('request')->query(),
                ['id' => $this->id, 'value' => $newValue]
            )
        );
    }
}
