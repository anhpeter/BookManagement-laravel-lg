<?php

namespace App\View\Components;

use App\Common\Helper\MyHelper;
use Illuminate\View\Component;

class OrderCart extends Component
{
    public $order;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-cart');
    }

    public function getTotal()
    {
        return array_reduce(MyHelper::convertStdClassToArray($this->order->books), function ($prev, $item) {
            return $prev + $item['price'] * $item['pivot']['qty'];
        }, 0);
    }
}
