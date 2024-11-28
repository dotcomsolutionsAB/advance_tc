<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    //
    //register user
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => [
                    'required',
                    'string',
                    'email',
                    'unique:users,email', // Ensure the email is unique in the 'users' table
                    function ($attribute, $value, $fail) {
                        // Check for custom email validation to include shortest domain like '.bit'
                        $pattern = '/^[\w\.\-]+@[\w\-]+\.[a-zA-Z]{2,3}$/';
                        if (!preg_match($pattern, $value)) {
                            $fail($attribute . ' is not a valid email address.');
                        }
                    },
                ],
            'mobile' => 'required|string|min:13|max:17',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,user',
        ]);
        
        $register_user = User::create([
            'username' => $request->input('username'),
            'email' => strtolower($request->input('email')),
            'mobile' => strtolower($request->input('mobile')),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        unset($register_user['id'], $register_user['created_at'], $register_user['updated_at']);
    
        return isset($register_user) && $register_user !== null
        ? response()->json(['User created successfully!', 'data' => $register_user], 201)
        : response()->json(['Failed to create successfully!'], 400);
    }
}
