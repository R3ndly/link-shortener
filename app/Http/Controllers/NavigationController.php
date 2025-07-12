<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class NavigationController
{
    public function LoginForm(): View
    {
        return view('auth.login');
    }

    public function RegisterForm(): View
    {
         return view('auth.register');
    }

    public function Profile(): View
    {
        return view('profile');
    }

    public function userLinks(): View
    {
        return view('links.index');
    }
}
