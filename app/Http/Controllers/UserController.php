<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Validate the request data
        // $validatedData = $request->validate([
        //     'firstname' => 'required|string|max:50',
        //     'lastname' => 'required|string|max:50',
        //     'email' => 'required|string|email|max:50|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // Create a new user
        $user = \App\Models\User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Return a response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
}
