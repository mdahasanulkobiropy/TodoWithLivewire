<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layout.app')]
class LoginPage extends Component
{
    public $email = '';
    public $password = '';
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];


    public function render()
    {
        return view('livewire.login-page');
    }
    public function loginUser()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('message', 'Logged in successfully!');
            return redirect()->to('/');
        } else {
            session()->flash('error', 'Invalid credentials. Please try again.');
            $this->reset(['password']);
        }
    }
}
