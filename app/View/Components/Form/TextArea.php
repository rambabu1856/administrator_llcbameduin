<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $grid;
    public $name;
    public $lblClass;
    public $lblText;
    public $value;

    public function __construct($name, $lblClass, $lblText, $value = null, $grid)
    {
        $this->name = $name;
        $this->lblClass = $lblClass;
        $this->lblText = $lblText;
        $this->value = $value;
        $this->grid = $grid;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.text-area');
    }
}
