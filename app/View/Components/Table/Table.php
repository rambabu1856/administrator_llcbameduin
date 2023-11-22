<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Table extends Component
{

    public array $tableHeaders;
    public  $id;

    public function __construct($tableHeaders, $id)
    {
        $this->tableHeaders = $tableHeaders;
        $this->id = $id;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.table');
    }
}
