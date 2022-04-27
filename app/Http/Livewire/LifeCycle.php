<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class LifeCycle extends Component
{
    public $name = 'Billy Bob Thorton';
    public $adj = 'awesome';

    // On page load --> first item to render

//     public function mount()
//     {
//         $this->name = 'Foo';
//     }

//
    public function mount(Request $request, $name)
    {
        $this->name = $request->input('name', $name);
    }

//    updated()
//    cpls forms with Livewire

    public function render()
    {
        return view('livewire.life-cycle');
    }
}
