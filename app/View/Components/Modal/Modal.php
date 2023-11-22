<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Modal extends Component
{

    public  $id;
    public  $modalSize;

    public function __construct($id, $modalSize)
    {
        $this->id = $id;
        $this->modalSize = $modalSize;
    }


    public function render()
    {
        return view('components.modal.modal');
    }
}
