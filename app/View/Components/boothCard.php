<?php

namespace App\View\Components;

use Illuminate\View\Component;

class boothCard extends Component
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $event_id;
    public $user_id;
    public $isAvailable;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $description, $location, $img, $price, $event_id = null, $user_id = null, $isAvailable = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->event_id = $event_id;
        $this->user_id = $user_id;
        $this->isAvailable = $isAvailable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.booth-card');
    }
}
