<?php

namespace App\View\Components;

use App\Common\Config\MyConfig;
use Illuminate\View\Component;

class ItemActionBar extends Component
{
    public $controller;
    public $id;
    public $name;
    public $template;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($controller, $id, $name)
    {
        $this->controller = $controller;
        $this->name = $name;
        $this->id = $id;
        $this->template = MyConfig::getItemTemplateForController($this->controller, 'action');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-action-bar');
    }
}
