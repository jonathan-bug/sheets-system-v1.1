<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    
    public $options;
    public $current;
    
    public function __construct($current)
    {
        $this->options = [
            [
                'key' => 'dashboard',
                'route' => route('dashboard'),
                'title' => 'Dashboard',
                'icon' => 'fa-home',
                'status' => false
            ], [
                'key' => 'employees',
                'route' => '#',
                'title' => 'Empleados',
                'icon' => 'fa-users',
                'status' => false
            ], [
                'key' => 'periods',
                'route' => '#',
                'title' => 'Periodos',
                'icon' => 'fa-calendar',
                'status' => false
            ], [
                'key' => 'sheets',
                'route' => '#',
                'title' => 'Hojas',
                'icon' => 'fa-copy',
                'status' => false
            ]
        ];

        for($i = 0; $i < count($this->options); $i++) {
            if($this->options[$i]['key'] == $current) {
                $this->options[$i]['status'] = true;
            }
        }

        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
