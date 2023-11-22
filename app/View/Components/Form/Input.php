<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $lblText;
    public $grid;
    public $lblClass;
    public $type;

    public function __construct($name, $lblText, $grid, $lblClass, $type)
    {
        $this->grid = $grid;
        $this->lblClass = $lblClass;
        $this->lblText = $lblText;
        $this->type = $type;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.form.input');
    }
}
