<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $namePattern = "/^([A-Z]\w*\s?)+$/";
        $passPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).*$/";
        $telPattern = "/^09\d{9}$/";

        $validated = $request->validate(
            [
                'first_name' => ['required', 'regex:'.$namePattern],
                'middle_name' => ['nullable', 'regex:'.$namePattern],
                'last_name' => ['required', 'regex:'.$namePattern],
                'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
                'username' => ['required', 'unique:users,username'],
                'password' => ['required', 'confirmed:confirm_password', 'min:8', 'regex:'.$passPattern],
                'confirm_password' => ['required', 'confirmed:password'],
                'contact_number' => ['required', 'regex:'.$telPattern],
            ],
            [
                'first_name.required' => 'First name is required!',
                'first_name.regex' => 'First name must start with uppercase only and contain alphabetic characters!',

                'middle_name.max' => 'Middle initial must be one character only!',
                'middle_name.regex' => 'Middle name must start with uppercase only and contain alphabetic characters!',

                'last_name.required' => 'Last name is required!',
                'last_name.regex' => 'Last name must only contain alphabetic characters and start with uppercase!',

                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email format!',
                'email.unique' => 'Email is already used!',

                'username.required' => 'Username is required!',
                'username.unique' => 'Username is taken!',

                'password.required' => 'Password is required!',
                'password.confirmed' => 'Passwords do not match!',
                'password.min' => 'Password must be at least 8 characters long!',
                'password.regex' => 'Password must have at least: Lowercase, Uppercase, Number, Special Character',

                'confirm_password.required' => 'Confirm Password is required!',
                'confirm_password.confirmed' => 'Passwords do not match!',

                'contact_number.required' => 'Contact number is required!',
                'contact_number.regex' => 'Contact number must be 11 characters long and start with "09"!',
            ],
        );

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login');
    }
}
