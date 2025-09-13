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
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'section' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(data: [
                'success' => false,
                'errors' => $errors,
            ], status: 422);
        }

        $FirstName = $request->firstname;
        $LastName = $request->lastname;
        $section = $request->section;
        $email = $request->email;
        $password = $request->password;

        $result  = User::create([
            'firstname' => $FirstName,
            'lastname' => $LastName,
            'section' => $section,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return response([
            'result' => $result,
        ], status: Response::HTTP_CREATED);
    }
}
