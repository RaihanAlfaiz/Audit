@extends('layouts.master')
@section('breadcrumb-items')
<span class="text-muted fw-light">Package / Create</span>
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
                    <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name Package</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the Package's name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                
                            </div>

                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                @error('item')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="item" type="hidden" name="item" value="{{ old('item') }}">
                                <trix-editor input="item"></trix-editor>
                              </div>

                            
                              <div class="mb-3">
                                <label for="selectpickerBasic" class="form-label">Type</label>
                                <select id="selectpickerBasic"class="selectpicker w-100" data-style="btn-default" name="type">
                                    @if(Auth::user()->hasRole('EE') || Auth::user()->hasRole('AD'))
                                     <option value="EE">Engagement and enrollment</option>
                                     @endif
                                     @if(Auth::user()->hasRole('ME'))
                                      <option value="ME">Moon Event</option>
                                      @endif
                                      @if(Auth::user()->hasRole('BM'))
                                         <option value="BM">Building Management</option>
                                     @endif
                                </select>
                              </div>

                        </div>

                        <div class="col-md-6">
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

                            <div class="mb-3">
                                <label for="body" class="form-label">Service</label>
                                @error('service')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="service" type="hidden" name="service" value="{{ old('service') }}">
                                <trix-editor input="service"></trix-editor>
                              </div>

                              <div class="mb-3">
                                <label for="selectpickerBasic" class="form-label">Pack</label>
                                <select id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default" name="pack">
                                    <option value="lt">Lecture Theatre</option>
                                    <option value="audit">Auditorium</option>
                                </select>
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
<script>
    $(".selectpicker").selectpicker();
</script>
<!-- Jika diperlukan script tambahan -->

@endsection