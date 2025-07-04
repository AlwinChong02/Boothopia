<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notification extends Component
{
    public $type;
    public $message;

    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.notification');
    }
}
