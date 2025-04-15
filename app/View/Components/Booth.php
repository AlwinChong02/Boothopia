<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Booth extends Component
{
    public $name;
    public $description;
    public $location;
    public $img;
    public $price;

    /**
     * Booth's component instance.
     * @param int $id
     * @param string $name
     * @param string|null $description
     * @param string|null $location
     * @param string|null $img
     * @param float $price
     */
    public function __construct($id, $name, $description = null, $location = null, $img = null, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->img = $img;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.booth');
    }
}