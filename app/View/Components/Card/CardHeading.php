<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class CardHeading extends Component
{
    public $heading;

    public function __construct($heading)
    {
        $this->heading = $heading;
    }
    public function render()
    {
        return view('components.card.card-heading');
    }
}
