<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function listStaff()
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
        return view('staff.register');
    }

    public function getUserPermissions(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $permissions = $user->getAllPermissions()->pluck('name');

        return response()->json(['permissions' => $permissions]);
    }


    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string'
        ]);

        try {
            // Create the user
            $staff = User::create([
                'type' => 'staff',
                'user_type' => $request->user_type,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'active'
            ]);

            // Assign role to the user
            if ($role = Role::where('name', $request->user_type)->first()) {
                $staff->assignRole($role);
            }

            // Flash message and redirect on successful registration
            session()->flash('user_registered', 'A new user has been registered.');
            return redirect()->route('staff.login');
        } catch (\Exception $e) {
            // Handle any exception that occurred during the user creation
            return back()->withErrors(['error' => 'User registration failed: ' . $e->getMessage()]);
        }
    }
}
