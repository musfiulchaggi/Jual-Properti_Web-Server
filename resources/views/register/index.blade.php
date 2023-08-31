@extends('layouts.main')

@section('container')

<div class="row">
    <div class="col-md-6 mx-auto">
        <main class="form-registration">
            <form action="/register" method="POST">
            {{-- digunakan untuk mencegah terjadinya cross site scripting --}}
            @csrf
              <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
                
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') 
                is-invalid
                @enderror
                " id="floatingName" placeholder="name@example.com" required value="{{ old('name') }}">
                <label for="floatingName" >Name</label>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="text" name="username" class="form-control
                @error('username') 
                is-invalid
                @enderror
                " id="floatingUsername" placeholder="name@example.com" required value="{{ old('username') }}">
                <label for="floatingUsername">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="email" name="email" class="form-control
                @error('email') 
                is-invalid
                @enderror
                " id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="password" name="password" class="form-control rounded-bottom
                @error('password') 
                is-invalid
                @enderror
                " id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
          
          
              <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Register</button>
        
            </form>

            {{-- karena small merupakan inline maka harus menggunakan d-block untuk mengubah menjadi bentuk block --}}
            <small class="d-block text-center mt-3">Already Registered? <a href="/login">Login</a></small>
          </main>
    </div>
</div>

@endsection