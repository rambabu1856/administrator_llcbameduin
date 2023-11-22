<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Card extends Component

{
    public $heading;

    public function __construct($heading)
    {
        $this->heading = $heading;
    }

    public function render()
    {
        return view('components.form.card');
    }
}
