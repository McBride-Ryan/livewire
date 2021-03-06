<?php
namespace App\Http\Livewire\Auth;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
class Registration extends Component
{
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';


    public function updatedEmail()
    {
        // dd($field); messages out the field object -- email or password
        // dd('hey');
        $this->validate(['email'=>'unique:users']);
    }

    public function updatedPassword()
    {
        // dd($field); messages out the field object -- email or password
        // dd('hey');
        $this->validate(['password'=>'']);
    }

    public function register()
    {
        $data = $this->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        auth()->login($user);

        return redirect('/registration');
    }

    public function render()
    {
        return view('livewire.auth.registration');
    }
}
