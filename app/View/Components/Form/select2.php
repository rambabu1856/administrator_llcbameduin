<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class select2 extends Component
{

    public $grid, $lblClass, $name, $lblText,  $options; //$selectedOptionVariables

    public function __construct($grid, $lblClass, $name, $lblText,  $options,) //$selectedOptionVariables
    {
        $this->grid = $grid;
        $this->lblClass = $lblClass;
        $this->name = $name;
        $this->lblText = $lblText;
        $this->options = $options;
        // $this->selectedOptionVariables = $selectedOptionVariables;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select2');
    }
}
