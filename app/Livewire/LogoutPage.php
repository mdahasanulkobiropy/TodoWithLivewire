<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layout.app')]
class LogoutPage extends Component
{
    public function render()
    {
        return view('livewire.logout-page');
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('message', 'Logged out successfully!');

        return redirect()->to('/');
    }
}
