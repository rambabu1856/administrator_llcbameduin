<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class AnchorTag extends Component
{
    public $grid;
    public $href;
    public $text;
    public $anchorTagClass;
    public $faClass;

    public function __construct($grid, $href, $text, $anchorTagClass, $faClass)
    {
        $this->grid = $grid;
        $this->href = $href;
        $this->text = $text;
        $this->anchorTagClass = $anchorTagClass;
        $this->faClass = $faClass;
    }
    public function render()
    {
        return view('components.button.anchor-tag');
    }
}
