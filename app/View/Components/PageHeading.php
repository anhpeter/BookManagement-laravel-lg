<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeading extends Component
{
    public $title;
    public $color;
    public $btnIcon;
    public $btnContent;
    public $btnLink;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = 'title', $color = 'primary',  $btnIcon = '', $btnContent = '', $btnLink = null)
    {
        //
        $this->color = $color;
        $this->title = $title;
        $this->btnIcon = $btnIcon;
        $this->btnContent = $btnContent;
        $this->btnLink = $btnLink;
    }

    public function hasBtn()
    {
        return ($this->btnIcon !== '' || $this->btnContent !== '');
    }

    /**
     * Get the view /  that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-heading');
    }
}
