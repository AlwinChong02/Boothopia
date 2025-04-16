<?php

namespace App\View\Components;

use Illuminate\View\Component;

class eventCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @param \App\Models\Event $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event-card');
    }
}
