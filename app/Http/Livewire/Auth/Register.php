<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = 'Billy Bob Thorton';
    public $adj = 'awesome';

    // On page load --> first item to render

    // public function mount()
    // {
    //     $this->name = 'Foo';
    // }

    // DEPENDENCY INJECT INTO THE MOUNT METHOD
    // You can also access the request from the inital pay load
    // Using the request object and passing it in as a parameter it allows
    //  the request to target the input with the wired 'name' variable

    public function mount(Request $request, $name)
    {
        $this->name = $request->input('name', $name);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
