<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $login;

    public $password;

    public $remember_me = false;

    #[Layout('components.layouts.guest.app')]
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (in_array($user->role,['admin'])) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'customer') {
                return redirect()->route('customer.index');
            }
        }
    }

    public function submit()
    {
        $this->validate([
            'login' => 'required|string',
            'password' => 'required|min:6',
            'remember_me' => 'nullable|boolean',
        ]);

        $fieldType = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $credentials = [
            $fieldType => $this->login,
            'password' => $this->password
        ];

        if (!Auth::attempt($credentials, $this->remember_me)) {
            throw ValidationException::withMessages([
                'login' => 'These credentials do not match our records.',
            ]);
        }

        $user = Auth::user();

        $adminRole = ['admin'];

        if (in_array($user->role, ['admin'])) {
            return to_route('admin.dashboard')->with('success', 'Successfully Login as'. $user->role . '.');
        }

        if ($user->role === 'customer') {
            return to_route('customer.index')->with('success', 'Login as company successfully.');
        }

        Auth::logout();
        throw ValidationException::withMessages([
           'login' => 'Unauthorized access.',
        ]);
    }
}
