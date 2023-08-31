@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-6 mx-auto">
            {{-- alert --}}

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ session('success') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{ session('failed') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin">
                <form action="/login" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Please Log in</h1>

                    <div class="form-floating">
                        <input type="email" name="email"
                            class="form-control 
                
                @error('email')
                     is-invalid
                @enderror
                "
                            id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            required>
                        <label for="password">Password</label>
                    </div>


                    <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>

                </form>

                {{-- karena small merupakan inline maka harus menggunakan d-block untuk mengubah menjadi bentuk block --}}
                {{-- <small class="d-block text-center mt-3">Not Registered? <a href="/register">Register Now!</a></small> --}}
            </main>
        </div>
    </div>
@endsection
