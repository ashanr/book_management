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

        $this->validateLogin($request);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User does not exist, return an error response
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
        $userType = $user->user_type;

        if ($userType === 'admin' || $userType === 'editor' || $userType === 'viewer') {
            $staffAuthController = new StaffAuthController();
            return $staffAuthController->login($request);
        } elseif ($userType === 'reader') {
            $readerAuthController = new ReaderAuthController();
            return $readerAuthController->login($request);
        }

        return back()->withErrors([
            'user_type' => 'Invalid user type selected.',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    }

}
