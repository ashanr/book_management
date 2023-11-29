<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserRegistered;


class ReaderRegistrationController extends Controller
{

    public function listReader()
    {
        $users = User::all();
        return view('staff.index', ['users' => $users]);
    }

    public function changeStatus(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back();
    }

    public function showRegistrationForm()
    {
        return view('reader.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'reader',
            'user_type' => 'reader',
        ]);

        // Add a flash message to the session
        session()->flash('user_registered', 'A new reader has been registered.');
        return redirect()->route('reader.login');
    }
}
