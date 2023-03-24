<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListPostCard extends Component
{
    public $posts;

    /**
     * The function takes an array of posts and assigns it to the posts property of the class
     * 
     * @param posts The posts to be displayed.
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-post-card');
    }
}
