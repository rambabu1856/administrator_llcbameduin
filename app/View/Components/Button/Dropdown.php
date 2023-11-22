<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $links, $btnClass;

    public function __construct($links, $btnClass)
    {
        $this->links = $links;
        $this->btnClass = $btnClass;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.dropdown');
    }
}
