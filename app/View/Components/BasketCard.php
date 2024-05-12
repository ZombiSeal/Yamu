<?php


namespace App\View\Components;

use Illuminate\View\Component;

class BasketCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $type;
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('basket.card');
    }
}
