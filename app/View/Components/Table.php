<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public $title;
    public $headers;
    public $route;
    public $paginator;
    public $perPageOptions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $headers = [], $route = null, $paginator = null, $perPageOptions = [10, 25, 50, 100])
    {
        $this->title = $title;
        $this->headers = $headers;
        $this->route = $route;
        $this->paginator = $paginator;
        $this->perPageOptions = $perPageOptions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
