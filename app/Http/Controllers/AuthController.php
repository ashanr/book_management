<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\ReaderAuthController;

class AuthController extends Controller
{
    public function loginDispatcher(Request $request)
    {

        //  $this->validateLogin($request);
        $user = User::where('email', $request->email)->first();


        if (!$user instanceof User) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.',
            ]);
        }
        // dd($user->user_type);
        $userType = $user->user_type;

        // if (!$userType) {
        //     return back()->withErrors([
        //         'user_type' => 'Invalid user type selected.',
        //     ]);
        // }

        if ($userType == 'admin' || $userType == 'editor' || $userType == 'viewer') {
            $staffAuthController = new StaffAuthController();
            return $staffAuthController->login($request);
        } elseif ($userType === 'reader') {
            $readerAuthController = new ReaderAuthController();
            return $readerAuthController->login($request);
        }

        return back()->withErrors([
            'user_type' => 'Invalid user selected.',
        ]);
    }
}
