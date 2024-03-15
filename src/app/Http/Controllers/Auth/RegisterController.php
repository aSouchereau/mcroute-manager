<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function getRegistrationForm(): Factory|View|Application
    {
        return view('auth.tmpregister');
    }

    public function register(Request $request)
    {
        if (User::query()->where('role', '=', 'admin')) {
            abort(403, 'An admin account already exists.');
        }

        $formData = $request->all();

        $user = User::create([
            'name'   => $formData['name'],
            'email'  => $formData['email'],
            'password' => Hash::make($formData['password']),
            'role' => 'admin'
        ]);

        return redirect('/');
    }
}
