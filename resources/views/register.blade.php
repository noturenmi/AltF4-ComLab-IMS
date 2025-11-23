@extends('layouts.master')

@php
    $fields = ['fname', 'lname', 'email', 'username', 'password', 'confirm-password', 'contact'];
    $label = '';
    $type = '';
@endphp
@section('content')
    <h1 class="text-center mt-5 fw-bold">AltF4 Solutions</h1>
    <form action="" method="post" class="mt-5 py-4 card col col-8 offset-2 text-light" style="background: #1D546C">
        <div class="card-body">
            <h1 class="text-center fw-bold">Register</h1>
            <div class="container d-flex flex-column mt-5">
                @foreach ($fields as $field)
                    @php
                        $type = 'text';
                    @endphp

                    @if ($field === 'fname')
                        @php
                            $label = 'First Name';
                        @endphp
                    @endif

                    @if ($field === 'lname')
                        @php
                            $label = 'Last Name';
                        @endphp
                    @endif
                    @if ($field === 'email')
                        @php
                            $label = 'Email';
                            $type = 'email';
                        @endphp
                    @endif

                    @if ($field === 'username')
                        @php
                            $label = 'Username';
                        @endphp
                    @endif

                    @if ($field === 'password')
                        @php
                            $label = 'Password';
                        @endphp
                    @endif

                    @if ($field === 'confirm-password')
                        @php
                            $label = 'Confirm Password';
                        @endphp
                    @endif

                    @if ($field === 'password' || $field === 'confirm-password')
                        @php
                            $type = 'password';
                        @endphp
                    @endif

                    @if ($field === 'contact')
                        @php
                            $type = 'tel';
                            $label = 'Contact Number';
                        @endphp
                    @endif

                    <label for="{{ $field }}" class="fw-bold">{{ $label }}</label>
                    <input type="{{ $type }}" name="{{ $field }}" id="{{ $label }}"
                        placeholder="Type your {{ $label }}"
                        class="mb-4 bg-transparent border-0 border-bottom text-light">
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
