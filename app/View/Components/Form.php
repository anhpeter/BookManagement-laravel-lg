<?php

namespace App\View\Components;

use App\Common\Config\MyConfig;
use Illuminate\View\Component;

class Form extends Component
{

    public $method;
    public $action;
    public $formData;
    public $isShowError;
    public $formFor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($method, $action, $formData = [], $isShowError = true, $formFor = '')
    {
        $this->method = $method;
        $this->action = $action;
        $this->formData = $formData;
        $this->isShowError = $isShowError;
        $this->formFor = $formFor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }

    public function getInputType($input)
    {
        return  $input['type'] ?? 'text';
    }

    public function getInputLabel($input)
    {
        return  $input['label'] ?? ucfirst($input['name']);
    }

    public function getInputContainerClass($input)
    {
        if ($this->getInputType($input) !== 'submit') return $this->getHtmlClass('input-container');
        return $this->getHtmlClass('submit-container');
    }

    public function isShowLabel($input)
    {
        return $this->getInputType($input) !== 'submit';
    }

    public function getHtmlClass($for)
    {
        switch ($for) {
            case 'label':
                return  'col-lg-2 col-form-label';
                break;
            case 'input-container':
                return 'col-lg-10';
            case 'submit-container':
                return 'offset-lg-2 d-flex justify-content-end col-md-10';
                break;
            case 'text-input':
                return 'form-control';
                break;
            case 'select-input':
                return 'custom-select';
                break;
        }
    }
}
