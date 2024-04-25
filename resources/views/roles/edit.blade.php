@extends('layouts.master')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6">
                        <form action="{{ route('roles.update', $roles->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="id" class="form-label">ID </label>
                                <input type="text" id="id" name="id" class="form-control" value="{{ $roles->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">title</label>
                                <input type="title" name="title" id="title" class="form-control" value="{{ $roles->title }}">
                            </div>
                        
                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection







