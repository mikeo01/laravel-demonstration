<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Form method
     *
     * @var string
     */
    public string $method;

    /**
     * Form action
     *
     * @var string
     */
    public string $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $method, string $action)
    {
        $this->method = $method;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form');
    }
}
