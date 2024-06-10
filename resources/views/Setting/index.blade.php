@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Settings</h1>
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @foreach($settings as $setting)
        <div class="form-group">
            <label for="{{ $setting->key }}">{{ ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
            <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $setting->value }}">
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
