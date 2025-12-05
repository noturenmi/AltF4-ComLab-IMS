@extends('layouts.master')

@section('content')
    <h1 class="text-center mt-5 fw-bold">AltF4 Solutions</h1>
    <form action="{{ route('login.auth') }}" method="POST" class="container-md card mt-5 py-4 text-light"
        style="background: #1D546C; border-radius: 1.5%">
        @csrf
        <div class="card-body">
            <h1 class="text-center fw-bold">Login</h1>
            <div class="container d-flex flex-column">
                <div class="form-floating">
                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder=""
                        autocomplete="off"
                        class="form-control bg-transparent border-0 rounded-0 border-bottom text-light mb-2">
                    <label for="username" class="fw-bold">Username</label>
                </div>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating">
                    <input type="password" name="password" id="password" placeholder="" autocomplete="off"
                        class="form-control bg-transparent border-0 rounded-0 border-bottom text-light mb-2">
                    <label for="password" class="fw-bold">Password</label>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @error('user')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class='d-flex flex-column container gap-5'>
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="" class='btn text-light'>Forgot password?</a>
                </div>
                <input type="submit" name="login" value="LOGIN"
                    class="btn btn-light rounded-pill col col-4 offset-4 fw-bold" style="color: #1D546C;">
                <a href="{{ route('register') }}" class="btn text-light">SIGN UP</a>
            </div>
        </div>
    </form>
@endsection
