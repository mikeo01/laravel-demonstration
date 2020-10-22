<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Input's type
     *
     * @var string
     */
    public string $type;

    /**
     * Input's id
     *
     * @var string
     */
    public ?string $id;

    /**
     * Input's name for form binding
     * 
     * @var string
     */
    public string $name;

    /**
     * Input's input
     *
     * @var ?string
     */
    public $value;

    /**
     * Input's placeholder
     * 
     * @var ?string
     */
    public ?string $placeholder;

    /**
     * Is this input required?
     * 
     * @var ?bool
     */
    public ?bool $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type, ?string $id, string $name, $value, ?string $placeholder, ?string $required)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->required = filter_var($required, FILTER_VALIDATE_BOOL) ?? false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
