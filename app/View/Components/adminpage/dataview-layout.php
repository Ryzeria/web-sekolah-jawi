<?php

namespace App\View\Components\adminpage;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class dataview-layout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.adminpage.dataview-layout');
    }
}
