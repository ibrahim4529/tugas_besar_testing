<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * Title Of Table
     *
     * @var string $title
     */
    public $title;
    /**
     * Resources url
     *
     * @var string $resource
     */
    public $resource;
    /**
     * For title in table thead
     *
     * @var array
     */
    public $header;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $resource, $header)
    {
        $this->title = $title;
        $this->header = $header;
        $this->resource = $resource;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}
