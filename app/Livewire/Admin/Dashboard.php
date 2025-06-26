<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;

class Dashboard extends Component
{
    public $user;
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        $this->user = User::get();
        return view('livewire.admin.dashboard',[
            'users' => $this->user
        ]);
    }
}
