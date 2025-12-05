@extends('layouts.master')

@php
    $fields = [
        'first_name' => 'First Name',
        'middle_name' => 'Middle Name (Optional)',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'contact_number' => 'Contact Number',
    ];
@endphp
@section('content')
    <h1 class="text-center mt-5 fw-bold">AltF4 Solutions</h1>
    <form action="{{ route('register.validate') }}" method="POST" class="card shadow my-5 py-4 col col-8 offset-2 text-light"
        style="background: #1D546C; border-radius: 1.5%">
        @csrf
        <div class="card-body">
            <h1 class="text-center fw-bold">Register</h1>
            <div class="container d-flex flex-column mt-5">
                @foreach ($fields as $field => $label)
                    <div class="form-floating">
                        <input type="{{ str_contains($field, 'password') ? 'password' : 'text' }}" name="{{ $field }}"
                            id="{{ $field }}" value="{{ old($field) }}" placeholder="" autocomplete="off"
                            class="form-control mb-2 bg-transparent border-0 border-bottom rounded-0 text-light">
                        <label for="{{ $field }}" class="fw-bold">{{ $label }}</label>
                    </div>
                    @error($field)
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                @endforeach
            </div>
            <div class='d-flex flex-column container gap-5 mt-5'>
                <input type="submit" name="submit" value="SUBMIT"
                    class="btn btn-light rounded-pill col col-4 offset-4 fw-bold" style="color: #1D546C;">
                <p class="text-center">Already have an account?
                    <a href="{{ route('login') }}" class="btn text-light fw-bold p-0">LOGIN</a>
                </p>
            </div>
        </div>
    </form>
@endsection
