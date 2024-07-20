@extends('layouts.master')
@section('breadcrumb-items')
<span class="text-muted fw-light">Service / Create</span>
@endsection
@section('css') 
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />

@endsection
@section('content')

<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                    <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                <input type="text" name="item" class="form-control @error('item') is-invalid @enderror" id="item" placeholder="Enter the Name's item" value="{{ old('item') }}">
                                @error('item')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror                                
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the Price" value="{{ old('price') }}">
                                </div>
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="number" name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Enter the Total unit" value="{{ old('unit') }}">
                                @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror                                
                            </div>

                            <div class="mb-3">
                                <label for="unit_name" class="form-label">Unit Name</label>
                                <input type="text" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" id="unit_name" placeholder="Example : Ruangan, Set Buah" value="{{ old('unit_name') }}">
                                @error('unit_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror                                
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>      
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script> 

<!-- Jika diperlukan script tambahan -->
<script>
       
</script>
@endsection