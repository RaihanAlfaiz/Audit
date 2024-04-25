@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card text-white bg-primary">
              <div class="card-header">{{ __('Dashboard') }}</div>
              <div class="card-body">
                <h5 class="card-title text-white">{{ ('Selamat datang !') }}</h5>
                <p class="card-text">
                    {{ Auth::user()->name }}
                </p>
              </div>
            </div>
          </div>
        
    </div>
</div>
@endsection
