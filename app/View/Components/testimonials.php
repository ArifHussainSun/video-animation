<?php

namespace App\View\Components;

use App\Models\Testimonial;
use Illuminate\View\Component;

class testimonials extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $testimonials = Testimonial::where('active',1)->whereNull('deleted_at')->get();
        return view('components.testimonials', compact('testimonials'));
    }
}
