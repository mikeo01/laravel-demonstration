<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    /**
     * Label for
     *
     * @var string
     */
    public string $for;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $for)
    {
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.label');
    }
}
