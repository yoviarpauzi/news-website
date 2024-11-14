<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class Postcard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Post $post, public string $class = "") {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.postcard');
    }
}
