<?php

namespace App\View\Components\Layouts\Administrator;

use Illuminate\View\Component;

class contentHeader extends Component
{
    public $contentHeader;
    public function __construct($contentHeader)
    {
        $this->contentHeader = $contentHeader;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.administrator.content-header');
    }
}
