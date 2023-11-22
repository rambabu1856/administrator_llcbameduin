<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Form extends Component
{

    public $name;


    public function __construct($name)
    {

        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.form');
    }
}
