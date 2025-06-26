<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name, $email, $password, $mobile, $password_confirmation, $role;

    public $data = [
        'roles' => [],
      ];
    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.create');
    }

    public function mount()
    {
        $this->data['roles'] = Role::whereIn('name', ['admin','customer'])->pluck('name', 'name');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'mobile' => 'nullable|string|max:15',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'mobile' => $this->mobile,
        ]);
        $user->assignRole($this->role);

        session()->flash('message', 'User created successfully.');
        return redirect()->route('admin.dashboard');
    }
}
