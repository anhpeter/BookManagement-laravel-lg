<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component
{

    public $search;
    public $searchData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($search, $searchData)
    {
        $this->search = $search;
        $this->searchData = $searchData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-bar');
    }

}
