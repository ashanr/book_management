<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ReaderAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to log in with the 'reader' guard
        if (Auth::guard('reader')->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            // Check if the user has the 'reader' role, assign if not
            if (!$user->hasAnyRole(['reader'])) {
                if ($role = Role::where('name', 'reader')->where('guard_name', 'reader')->first()) {
                    $user->assignRole($role);
                }
            }

            // Redirect to the reader dashboard
            return redirect()->intended('/reader/dashboard');
        }

        // Redirect back with an error message if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match with records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('reader')->logout();
        return redirect('/login');
    }
}
