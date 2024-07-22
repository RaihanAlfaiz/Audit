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
        <!-- Register Card -->
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
            <p class="mb-4">create an account to enter the application!</p>
  
            <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
                @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select" name="role">
                  @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                  @endforeach
                </select>
            </div>


              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
  
              <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">

              </div>
            
              <button class="btn btn-primary d-grid w-100">
                Sign up
              </button>
            </form>
  
            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{url('login')}}">
                <span>Sign in instead</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>