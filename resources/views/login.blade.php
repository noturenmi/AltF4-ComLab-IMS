@extends('layouts.master')

@section('content')
    <h1 class="text-center mt-5 fw-bold">AltF4 Solutions</h1>
    <form action="" method="post" class="card mt-5 py-4 col col-8 offset-2 text-light"
        style="background: #1D546C; border-radius: 1.5%">
        <div class="card-body">
            <h1 class="text-center fw-bold">Login</h1>
            <div class="container d-flex flex-column">
                <label for="username" class="fw-bold">Username</label>
                <input type="text" name="username" value=""
                    class="mb-4 bg-transparent border-0 border-bottom text-light">
                <label for="password" class="fw-bold">Password</label>
                <input type="password" name="password" value=""
                    class="bg-transparent border-0 border-bottom text-light">
            </div>
            <div class='d-flex flex-column container gap-5'>
                <a href="" class='btn text-end text-light'>Forgot password?</a>
                <input type="submit" name="login" value="LOGIN"
                    class="btn btn-light rounded-pill col col-4 offset-4 fw-bold" style="color: #1D546C;">
                <a href="{{ route('register') }}" class="btn text-light">SIGN UP</a>
            </div>
        </div>
    </form>
@endsection
