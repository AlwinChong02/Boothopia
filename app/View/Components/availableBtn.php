<?php

namespace App\View\Components;

use Illuminate\View\Component;

class availableBtn extends Component
{
    public $label;
    public $url;

    /**
     * Create a new component instance.
     *
     * @param string $label // button label
     * @param string $url // url for booth 
     */
    public function __construct( $url)
    {
        $this->label = 'Available';
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.available-btn');
    }
}