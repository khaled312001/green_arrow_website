<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SocialIcons extends Component
{
    public $size;
    public $showLabels;
    public $containerClass;

    /**
     * Create a new component instance.
     */
    public function __construct($size = 'fs-5', $showLabels = false, $containerClass = 'd-flex gap-2')
    {
        $this->size = $size;
        $this->showLabels = $showLabels;
        $this->containerClass = $containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.social-icons');
    }
}
