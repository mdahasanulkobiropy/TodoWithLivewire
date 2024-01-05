<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Layout('layout.app')]
class RegistrationPage extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $confirm_password = '';

    protected $rules = [
        'name' => 'required|min:3|max:30',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|max:30',
        'confirm_password' => 'required|same:password',
    ];

    public function render()
    {
        return view('livewire.registration-page');
    }

    public function registerUser()
    {

        $this->validate();
        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);
        Auth::login($user);
        session()->flash('message', 'User registered successfully!');
        return redirect()->to('/');
    }
}
