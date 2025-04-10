<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $value;
    public $icon;
    public $iconColor;
    public function __construct($title, $value, $icon, $iconColor)
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->iconColor = $iconColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
