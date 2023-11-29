<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class StaffAuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('staff')->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            // Check if the user already has a role to avoid re-assigning
            if (!$user->hasAnyRole(['admin', 'editor', 'viewer'])) {
                // Assign role based on user_type
                switch ($user->user_type) {
                    case 'admin':

                        if ($role = Role::where('name', 'admin')->where('guard_name', 'staff')->first()) {
                            $user->assignRole('admin');
                        }
                        break;
                    case 'editor':

                        if ($role = Role::where('name', 'editor')->where('guard_name', 'staff')->first()) {
                            $user->assignRole('editor');
                        }
                        break;
                    case 'viewer':

                        if ($role = Role::where('name', 'viewer')->where('guard_name', 'staff')->first()) {
                            $user->assignRole('viewer');
                        }
                        break;
                    default:

                        if ($role = Role::where('name', 'viewer')->where('guard_name', 'staff')->first()) {
                            $user->assignRole('viewer');
                        }
                        break;
                }
            }

            return redirect()->intended('/staff/dashboard');
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect('/login');
    }
}
