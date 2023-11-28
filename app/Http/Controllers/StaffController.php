<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
}
