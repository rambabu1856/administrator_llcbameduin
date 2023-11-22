<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Table extends Component
{
    public array $tableHeaders;

    public function __construct($tableHeaders)
    {
        $this->tableHeaders = $tableHeaders;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.table');
    }
}
