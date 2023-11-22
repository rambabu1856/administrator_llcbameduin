<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class Button extends Component
{
    public  $grid, $type, $btnClass, $name, $btnText, $faClass, $tooltip, $dataId;

    public function __construct($grid, $type, $btnClass, $name, $btnText, $faClass, $tooltip, $dataId)
    {
        $this->grid = $grid;
        $this->type = $type;
        $this->btnClass = $btnClass;
        $this->name = $name;
        $this->tooltip = $tooltip;
        $this->btnText = $btnText;
        $this->faClass = $faClass;
        $this->dataId = $dataId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.button');
    }
}
