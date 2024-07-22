@extends('layouts.authentication.master')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Auditorium | JGU  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Right Align Image Example</title>
                <style>
                    .container-right {
                        display: flex;
                        justify-content: flex-end;
                    }

                    .img-resize {
                        width: 350px; /* Contoh pengaturan lebar */
                        height: auto; /* Menjaga rasio aspek */
                    }
                </style>
                <style>
                body {
                  background-image: url('assets/img/rorr.jpg');
                  background-size: cover;
                  background-position: center;
                  background-repeat: no-repeat;
                  height: 100vh;
                 width: 100vw;
                 }
                header {
                background: rgba(255,255,225, 0.5);
                 }
            </style>
            </head>
            <body>
                <div class="container-right">
                    <img src="assets/img/login-ballroom.png" alt="Ballroom" class="img-resize">
                </div>
            </body>
            </html>
            <p class="mb-4">Welcome Back!</p>
            @if(session('status'))
            <div class="alert alert-warning" role="alert">
                {{ session('status') }}
            </div>
        @endif

            <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="{{ route('password.request') }}">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" aria-describedby="password" @error('password') is-invalid @enderror/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>
  
            <p class="text-center">
              <span>New on our platform?</span>
              <a href="{{url('/register')}}">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
  </div>
