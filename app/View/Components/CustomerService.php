<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomerService extends Component
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $leading_words = [];
        try {
            $leading_words = array_values(json_decode(app('cache.config')->get('leading_words'),true));
        }catch (\Exception $exception){

        }


        return view('components.customer-service',compact('leading_words'));
    }
}
